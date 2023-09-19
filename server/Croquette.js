const DataBase = require('./DataBase');
const { Server } = require("net");
const { newConnectionToAppServer, newDisconnectionToAppServer, serverAppConnect } = require('./http');


const listen = (host, port) => {
  const server = new Server();

  server.on('connection', (client) => {
    const clientAddress = `${client.remoteAddress}:${client.remotePort}`;
    console.log(`New connection from: ${clientAddress}`);
    client.setEncoding('utf-8');

    client.on('data', (request) => {
      console.log(`Received a new message from a connected client ${request}`);
      request.startsWith('SERVER_APP') ? 
      serverAppConnect(request) :  // Le manda el token con este formato SERVER_APP:stringTokenAppServer
      newConnectionToAppServer(request, client);
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
};

const main = () => {
  listen(DataBase.get('ServerSettings').get('host'), DataBase.get('ServerSettings').get('port'));
};

if (require.main === module) {
  main();
}
