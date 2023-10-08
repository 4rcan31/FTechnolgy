class ProcessCommands {
    request = {};
    serverAppClientSocket;
    connections;

    commands = {
        ping: 'ping',
        sendfood: 'sendfood',
        scheduleQuantity: 'scheduleQuantity'
    };

    constructor(request, serverAppClientSocket, connections) {
        this.request = request;
        this.serverAppClientSocket = serverAppClientSocket;
        this.connections = connections;
    }

    run() {
        if (this.request.command === this.commands.ping) {
            this.ping();
        } else if (this.request.command === this.commands.sendfood) {
            this.sendfood();
        } else if (this.request.command === this.commands.scheduleQuantity) {
            this.scheduleQuantity();
        }
    }

    ping() {
        this.responseSocketWithJson('pong', this.serverAppClientSocket);
        console.log("Sent 'pong' to Server App");
    }

    sendfood() {
        console.log("Received 'sendfood' command with token: " + this.request.tokenCroquette);
        this.newCommandSendToCroquette(
            "Dispensando comida...",
            "Se envió " + this.request.cantidad + " kilogramos a tu croquette :)", {
                tokenCroquette: this.request.tokenCroquette,
                cantidad: this.request.cantidad
            }
        );
    }

    scheduleQuantity() {
        this.newCommandSendToCroquette(
            "Se dispensará comida el " + this.request.date + " a las " + this.request.time,
            "Croquette dispensará " + this.request.cantidad + " kilogramos el " + this.request.date + " a las " + this.request.time + " :)",
            {
                tokenCroquette: this.request.tokenCroquette,
                cantidad: this.request.cantidad,
                date: this.request.date,
                time: this.request.time
            }
        );
    }

    newCommandSendToCroquette(responseCroquetteMessage, responseServerAppMessage, dataSendToCroquette = {}) {
        let CroquetteSendIndicationSocket = this.connections.get(this.request.tokenCroquette);
        if (CroquetteSendIndicationSocket) {
            this.responseSocketWithJson(responseCroquetteMessage, CroquetteSendIndicationSocket, {
                command: this.request.command,
                ...dataSendToCroquette
            });
            this.responseSocketWithJson(responseServerAppMessage, this.serverAppClientSocket, {
                state : true
            });
        } else {
            console.log(`No socket found for token: ${this.request.tokenCroquette}`);
            this.responseSocketWithJson("Su Croquette esta desconectado!", this.serverAppClientSocket, {
                state : false
            }); //Le dice a la app server que el croquette esta desconectado
        }
    }

    responseSocketWithJson(responseMessage, socketResponse, objectResponse = {}) {
        const response = {
            response: responseMessage,
            ...objectResponse
        };
        socketResponse.write(JSON.stringify(response));
    }
}

module.exports = { ProcessCommands };
