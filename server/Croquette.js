const DataBase = require('./DataBase');
const Server = require('net');


const listen = (port) => {
    const Server = new Server();

    Server.on('connection', (client) => {
        const clientAddress = `${client.remoteAddress}:${client.remotePort}`;
        console.log(`New connection from: ${clientAddress}`);
        client.setEncoding('utf-8');


        client.on('data', (request) => {
            //EL primer request debe de ser el type, ya sea crooquete or server
            if(request == 'croquette'){
                
            }


            if(!DataBase.get('Connections').has(request)){ // request se espera a que traiga un token
                console.log(`New Croquette connected from ${clientAddress} with token: ${request}`);
                DataBase.get()
            }
        });
    });
  
    server.on("connection", (socket) => {
      const remoteSocket = `${socket.remoteAddress}:${socket.remotePort}`;
      console.log(`New connection from ${remoteSocket}`);
      socket.setEncoding("utf-8");
  
      socket.on("data", (message) => {
        connections.values();
        if (!connections.has(socket)) {
          console.log(`Username ${message} set for connection ${remoteSocket}`);
          connections.set(socket, message);
        } else if (message === END) {
          connections.delete(socket);
          socket.end();
        } else {
          const fullMessage = `[${connections.get(socket)}]: ${message}`;
          console.log(`${remoteSocket} -> ${fullMessage}`);
          sendMessage(fullMessage, socket);
        }
      }); 
  
      socket.on("error", (err) => console.error(err));
  
      socket.on("close", () => {
        console.log(`Connection with ${remoteSocket} closed`);
      });
    });
  
    server.listen({ port, host }, () => {
      console.log(`Listening on ${host}:${port}`);
    });
  
    server.on("error", (err) => error(err.message));
  };