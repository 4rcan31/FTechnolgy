


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
ClientServer.set('token', 'tokenstringsecret');
ClientServer.set('name', 'nameServer');
ClientServer.set('host', 'host');

// Agregar el objeto ServerData al mapa principal
DataBase.set('ClientServer', ClientServer);

// Agregar una matriz vacía para Connections

/* 
    token -> socket
    token -> socket
*/
const connections = new Map;
DataBase.set('Connections', connections);

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