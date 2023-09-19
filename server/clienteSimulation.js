const { Socket } = require("net");
// Desactivar el buffering de la entrada/salida estándar


const tokenCroquette = "a20412736e926666573981193f5319ff78a5bccbc958df73d6e6bfce311193f6";


const error = (message) => {
  console.error(message);
  process.exit(1);
};

const connect = (host, port) => {
  const socket = new Socket();
  socket.connect({ host, port });
  socket.setEncoding("utf-8");

  socket.on("connect", () => {
    console.log(`Connected to ${host}:${port}`);

    /* 
        1. El codigo qr se escanea y se ancla a un usuario (opcional)
        2. Croquette se enciende
        3. Hay 2 opciones para configurar croquette
            3.1 Default
            3.2 Custom
        4. Tiene que elegir una de 3.1 o 3.2 por obligacion (Esto funciona sin la app aun)
        5. Para conectar a croquette con la app (para esto si es obligatorio el paso 1)
        6. Mantener el boton de up por 10 segundos para conectarse a la app
        7. Croquette envia el token al server middleware y se conecta
    */
    socket.write(tokenCroquette);


    socket.on("data", (data) => {
        console.log(data);
    });

  });

  socket.on("error", (err) => error(err.message));

  socket.on("close", () => {
    console.log("Disconnected");
    process.exit(0);
  });
};

const main = () => {
  if (process.argv.length !== 4) {
    error(`Usage: node ${__filename} host port`);
  }

  let [, , host, port] = process.argv;
  if (isNaN(port)) {
    error(`Invalid port ${port}`);
  }
  port = Number(port);

  connect(host, port);
};

if (module === require.main) {
  main();
}