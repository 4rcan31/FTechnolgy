


/* 
    ClientServer -> [
        token -> 'tokenstringsecret'
        name -> 'nameServer'
        host -> 'host'
    ],
    Connections -> [],
    ServerSettings -> [
        host -> 127.0.0.1
        port -> 8081
    ]
*/
// Crear un nuevo mapa
const DataBase = new Map();

// Crear el objeto ClientServer
const ClientServer = new Map();
ClientServer.set('tokenAuth', '95259142cfdab11d7e29b93b0f6414d50313152e7d1d97cbd47f6ba0ff4c420f');
ClientServer.set('name', 'nameServer');
ClientServer.set('host', 'http://127.0.0.1');
ClientServer.set('port', "8080");
ClientServer.set('pathUrlApiCroquette', '/api/v1/signal/croquette/servercroquettemiddleware');
ClientServer.set('pathUrlsetConnection', '/setStatusConnection');
ClientServer.set('pathUrlsetDisconnection', '/newDisconnection');
/* ClientServer.set('urlapi', `${ClientServer.get('host')}/api/v1`);
ClientServer.set('urlApiSendToken', `${ClientServer.get('urlapi')}/signal/croquette/setStatusConnection`); */


// Agregar el objeto ServerData al mapa principal
DataBase.set('ClientServer', ClientServer);

// Agregar una matriz vacía para Connections

/* 
    token -> socket
    token -> socket
*/
const connections = new Map;
DataBase.set('connections', connections);

//Objeto para congfiguracion de este servidor
const ServerSettings = new Map;
ServerSettings.set('host', '127.0.0.1');
ServerSettings.set('port', 8081);
DataBase.set('ServerSettings', ServerSettings);

module.exports = DataBase;

/* // Acceder a los valores en el mapa
console.log(DataBase.get('ServerData').get('token')); // 'tokenstringsecret'
console.log(DataBase.get('ServerData').get('name'));  // 'nameServer'
console.log(DataBase.get('ServerData').get('host'));  // 'host'
console.log(DataBase.get('Connections'));             // []

// Modificar los valores en el mapa
DataBase.get('ServerData').set('name', 'NuevoNombre');
console.log(DataBase.get('ServerData').get('name'));  // 'NuevoNombre'
 */