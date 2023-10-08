const DataBase = require('./DataBase');
const { Server } = require("net");
const { 
  newConnectionToAppServer,
  newDisconnectionToAppServer,
  serverAppConnect,
  handleServerShutdown 
} = require('./http');


const listen = (host, port) => {
  const server = new Server();

  server.on('connection', (client) => {
    const clientAddress = `${client.remoteAddress}:${client.remotePort}`;
    console.log(`New connection from: ${clientAddress}`);
    client.setEncoding('utf-8');

    client.on('data', (request) => {
      request = JSON.parse(request);
      if (request && request.typeApp) {
        if (request.typeApp === 'SERVER_APP') {
          serverAppConnect(request, client);
        } else  if(request.typeApp == 'CROQUETTE_APP'){
          newConnectionToAppServer(request, client);
        }
      } else {
        console.error('El objeto request no tiene la propiedad "type" o es nulo.');
      }
    });

    client.on("error", (err) => console.error(err));

    client.on("close", () => {
      newDisconnectionToAppServer(client);

      console.log(`Connection with ${clientAddress} closed`);
    });
  });

  server.listen({ port, host }, () => {
    console.log(`Croquette server middleware listening on ${host}:${port}`);
  });

  server.on("error", (err) => {
    console.error(err.message);
    process.exit(1);
  });

  handleServerShutdown(server);
};

const main = () => {
  listen(DataBase.get('ServerSettings').get('host'), DataBase.get('ServerSettings').get('port'));
};

if (require.main === module) {
  main();
}








// Uso:
// configureServerShutdownHandling(server);

