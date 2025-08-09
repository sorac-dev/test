// nodo.js
const fs = require('fs');
const https = require('https');
const { Server } = require('socket.io');

// ---------------------
// Configuración HTTPS
// ---------------------
const options = {
    key: fs.readFileSync('key.pem'),
    cert: fs.readFileSync('cert.pem'),
    ca: fs.readFileSync('cert.pem') // si tienes CA aparte, cámbialo
};

const puerto = 8443;
const app = https.createServer(options);
const io = new Server(app, {
    transports: ['websocket'],
    cors: {
        origin: "*",
        methods: ["GET", "POST"]
    }
});

app.listen(puerto, () => {
    console.log(`Servidor de señalización HTTPS activo en puerto ${puerto}`);
});

// ---------------------
// Variables globales
// ---------------------
const channels = {};

// ---------------------
// Conexión principal
// ---------------------
io.on('connection', (socket) => {
    console.log(`Cliente conectado al servidor principal: ${socket.id}`);
    let initiatorChannel = '';

    // Cuando un cliente crea un nuevo canal
    socket.on('new-channel', (data) => {
        if (!channels[data.channel]) {
            channels[data.channel] = data.channel;
            onNewNamespace(data.channel);
            console.log(`Nuevo canal registrado: ${data.channel}`);
        } else {
            console.log(`Canal ya existente: ${data.channel}`);
        }
    });

    // Comprobar si existe un canal
    socket.on('presence', (channel) => {
        const isChannelPresent = !!channels[channel];
        socket.emit('presence', isChannelPresent);
        if (!isChannelPresent) {
            initiatorChannel = channel;
        }
    });

    socket.on('disconnect', () => {
        console.log(`Cliente desconectado del servidor principal: ${socket.id}`);
        if (initiatorChannel) {
            channels[initiatorChannel] = null;
        }
    });
});

// ---------------------
// Función para crear namespace dinámico
// ---------------------
function onNewNamespace(channel) {
    // Evitar recrear listeners para el mismo canal
    if (io._nsps.has(`/${channel}`)) return;

    const nsp = io.of(`/${channel}`);

    nsp.on('connection', (socket) => {
        console.log(`Cliente conectado al namespace: /${channel}`);

        // Avisar que el namespace está listo
        socket.emit('namespace-ready');

        // Reenviar todos los mensajes a los demás clientes del namespace
        socket.on('message', (data) => {
            socket.broadcast.emit('message', data.data);
        });

        socket.on('disconnect', () => {
            console.log(`Cliente desconectado del namespace: /${channel}`);

            // Si ya no quedan clientes en este namespace, limpiar
            if (nsp.sockets.size === 0) {
                console.log(`Namespace vacío, eliminando canal: ${channel}`);
                delete channels[channel];
                delete io._nsps.get(`/${channel}`);
            }
        });
    });
}
