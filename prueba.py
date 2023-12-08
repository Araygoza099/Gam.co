import socket
import struct
import threading

def recibir_mensajes(sock, direccion_grupo, puerto, usuario):
    grupo = socket.inet_aton(direccion_grupo)
    miembro = socket.inet_aton('0.0.0.0')  # Escucha en todas las interfaces de red
    mcast_grupo = grupo + miembro

    # Configurar la interfaz y unirse al grupo multicast
    sock.setsockopt(socket.IPPROTO_IP, socket.IP_ADD_MEMBERSHIP, struct.pack('4sL', grupo, socket.INADDR_ANY))

    sock.bind(('', puerto))

    while True:
        mensaje, direccion = sock.recvfrom(1024)
        origen = direccion[0]
        print(f"{usuario} recibió de {origen}: {mensaje.decode('utf-8')}")

def enviar_mensajes(sock, direccion_grupo, puerto, usuario):
    mcast_grupo = socket.inet_aton(direccion_grupo)
    sock.setsockopt(socket.IPPROTO_IP, socket.IP_MULTICAST_TTL, 2)

    while True:
        mensaje = input("")
        mensaje_con_usuario = f"{usuario}: {mensaje}"
        sock.sendto(mensaje_con_usuario.encode('utf-8'), (direccion_grupo, puerto))

if __name__ == "__main__":
    direccion_grupo = "224.1.1.1"
    puerto = 5007

    usuario_id = input("Ingresa tu ID: ")
    usuario_nombre = input("Ingresa tu nombre de usuario: ")

    sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM, socket.IPPROTO_UDP)
    sock.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
    sock.setsockopt(socket.IPPROTO_IP, socket.IP_MULTICAST_LOOP, 1)

    recibir_thread = threading.Thread(target=recibir_mensajes, args=(sock, direccion_grupo, puerto, usuario_nombre))
    enviar_thread = threading.Thread(target=enviar_mensajes, args=(sock, direccion_grupo, puerto, usuario_nombre))

    recibir_thread.start()
    enviar_thread.start()

    recibir_thread.join()
    enviar_thread.join()
