const axios = require("axios");
const { ProcessCommands } = require("./procesCommadsCroquette");
const { findKeyByValue } = require("./utils");
const DataBase = require("./DataBase");
const apiUrl =
  DataBase.get("ClientServer").get("host") +
  ":" +
  DataBase.get("ClientServer").get("port") +
  DataBase.get("ClientServer").get("pathUrlApiCroquette");

const setConnectionUrl =
  apiUrl + DataBase.get("ClientServer").get("pathUrlsetConnection");

const setDisconnectionUrl =
  apiUrl + DataBase.get("ClientServer").get("pathUrlsetDisconnection");
const setServerShutdown =
  apiUrl + DataBase.get("ClientServer").get("pathUrlHandleServerShutdown");

const headers = {
  "Content-Type": "application/json",
  "Auth-Token-Server-Middleware-Croquette":
    DataBase.get("ClientServer").get("tokenAuth"),
};

function newDisconnectionToAppServer(clientCroquetteSocket, end = false) {
  const token = findKeyByValue(
    DataBase.get("connections"),
    clientCroquetteSocket
  );
  if (token) {
    axios
      .post(`${setDisconnectionUrl}/${token}`, {}, { headers })
      .then((response) => {
        console.log(response.data);
        if (response.data.state === true) {
          DataBase.get("connections").has(clientCroquetteSocket)
            ? DataBase.get("connections").delete(clientCroquetteSocket)
            : console.error(
                `Se intento eliminar un cliente que no existe, su token es: ${token}`
              );
          if (end) {
            clientCroquetteSocket.end();
          }
          console.log("El cliente croquette se desconecto con exito!");
          console.log(response.data);
        }
      })
      .catch((error) => {
        console.error("Error making the request:", error);
      });
  } else {
    console.log("The sever app disconnected");
  }
}

function newConnectionToAppServer(requestObject, clientCroquetteSocket) {
  console.log(
    "New Croquette connected to Server Middleware Croquette, token: " +
      requestObject.tokenCroquette
  );
  axios
    .post(
      setConnectionUrl,
      { token: requestObject.tokenCroquette },
      { headers }
    )
    .then((response) => {
      if (response.data.state === true) {
        //Eso significa que todo ha ido bien, asi que tengo que guardar la conexion de croquette
        DataBase.get("connections").set(
          response.data.token,
          clientCroquetteSocket
        ); //Guardo el socket conectado y el token para identificarlo mmas adelante
        clientCroquetteSocket.write(JSON.stringify(response.data.message)); //Le envio a croquette el mensaje de respuesta de la conexion
      } else {
        if (response.data.message !== undefined) {
          clientCroquetteSocket.write(JSON.stringify(response.data.message));
        }
        console.log("Algo salio mal, response: ");
        console.log(response.data);
        console.log("Se intento hacer una peticion a " + setConnectionUrl);
        clientCroquetteSocket.end();
      }
    })
    .catch((error) => {
      console.error("Error making the request:", error);
    });
}

function serverAppConnect(request, serverAppClientSocket) {
  //request ya viene en modo objeto

  const commandsProcessor = new ProcessCommands(
    request,
    serverAppClientSocket,
    DataBase.get("connections")
  );

  commandsProcessor.run();
  serverAppClientSocket.end();
}

function handleServerShutdown(server) {
    process.on("SIGINT", () => {
      shutdown(
        server,
        "Se recibió una señal SIGINT (Ctrl+C). Cerrando el servidor..."
      );
    });
  
    process.on("SIGTERM", () => {
      shutdown(server, "Se recibió una señal SIGTERM. Cerrando el servidor...");
    });
  
    process.on("uncaughtException", (error) => {
      shutdown(server, "Error no controlado", error);
    });
  
    process.on("unhandledRejection", (reason, promise) => {
      shutdown(server, "Rechazo no controlado", reason);
    });
  
    process.on("exit", (code) => {
        console.log(`El servidor se desconectó con el código de salida ${code}`);
    });
  }
  
  function shutdown(server, message, error = null) {
    console.log(message);
    if (error) {
      console.error("Error:", error);
    }

    console.log("Servidor cerrado.");
    axios
      .post(
        setServerShutdown,
        {
          host: DataBase.get("ServerSettings").get("host"),
          port: DataBase.get("ServerSettings").get("port"),
          message: message,
          error: error,
          timestamp: new Date().toISOString(),
        },
        { headers }
      )
      .then((response) => {
          console.log("Se notificó correctamente al servidor de la aplicación que el servidor Croquette se detuvo por algún motivo.");
          console.log("El servidor de la aplicación respondió con:", response.data);
      })
      .catch((error) => {
        console.error("Error making the request:", error);
      })
      .finally(() => {
        server.close(() => {
            console.log("El servidor se cerro!");
        });
        process.exit(error ? 1 : 0);
      });



  }
  

module.exports = {
  newConnectionToAppServer,
  newDisconnectionToAppServer,
  serverAppConnect,
  handleServerShutdown,
};
