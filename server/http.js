
const axios = require('axios');
const DataBase = require('./DataBase');
const apiUrl =  DataBase.get('ClientServer').get('host') + ':' +
                DataBase.get('ClientServer').get('port') + 
                DataBase.get('ClientServer').get('pathUrlApiCroquette');

const setConnectionUrl = apiUrl +
                         DataBase.get('ClientServer').get('pathUrlsetConnection');

const setDisconnectionUrl = apiUrl +
                            DataBase.get('ClientServer').get('pathUrlsetDisconnection');

const headers = {
    'Content-Type': 'application/json',
    'Auth-Token-Server-Middleware-Croquette' : DataBase.get('ClientServer').get('tokenAuth')
};




function newDisconnectionToAppServer(clientCroquetteSocket, end = false){
    const token = DataBase.get('connections').get(clientCroquetteSocket);
    axios.post(`${setDisconnectionUrl}/${token}`, {}, {headers})
    .then((response) => {
        console.log(response.data);
        if(response.data.state === true){
            DataBase.get('connections').has(clientCroquetteSocket) ? 
            DataBase.get('connections').delete(clientCroquetteSocket) : 
            console.error(`Se intento eliminar un cliente que no existe, su token es: ${token}`);
            if(end){
                clientCroquetteSocket.end();
            }
            console.log("El cliente croquette se desconecto con exito!");
            console.log(response.data);
        }

    }).catch((error) => {
        console.error('Error making the request:', error);
    })

    
}
                              


function newConnectionToAppServer(requestToken, clientCroquetteSocket){
    axios.post(setConnectionUrl, { token: requestToken },  {headers} )
    .then((response) => {
        if(response.data.state === true){ //Eso significa que todo ha ido bien, asi que tengo que guardar la conexion de croquette
          DataBase.get('connections').set(clientCroquetteSocket, response.data.token); //Guardo el socket conectado y el token para identificarlo mmas adelante
          clientCroquetteSocket.write(JSON.stringify(response.data.message)); //Le envio a croquette el mensaje de respuesta de la conexion
        }else{ 
          clientCroquetteSocket.write(JSON.stringify(response.data.message));
          clientCroquetteSocket.end();
        }
    })
    .catch((error) => {
      console.error('Error making the request:', error);
    });
}

function serverAppConnect(stringToken){
    let token = stringToken.split(":")[1];
    console.log(`Server App Connected with token ${token}`);
}

module.exports = { newConnectionToAppServer, newDisconnectionToAppServer, serverAppConnect};
