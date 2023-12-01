<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help | Gam.co</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style_foo.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.3/tailwind.min.css" integrity="sha512-wl80ucxCRpLkfaCnbM88y4AxnutbGk327762eM9E/rRTvY/ZGAHWMZrYUq66VQBYMIYDFpDdJAOGSLyIPHZ2IQ==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@600&display=swap" rel="stylesheet"> 

    <style>
        * {
        font-family: 'Quicksand', sans-serif;
        color:#fff;
        }

        body{
            background-color: #00011e;
        }
    </style>   
</head>

<body>
    <article id="the-article">

    <?php include('header.php'); ?>

    <div>
        <div class="mx-auto max-w-6xl">
            <div class="p-2 rounded">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/3 p-4 text-sm">

                <div class="sticky inset-x-0 top-0 left-0 py-12">
                    
                        <div class="text-3xl text-green-400 mb-8" style="color: #ffc600;">Preguntas Frecuentes</div>
                        <div class="mb-2" style="color: #ffc600;">Gam.co</div>
                        <div class="text-xs text-gray-600" style="color: #fff;">Hasta Kratos pregunto, sientete seguro</div>

                        <div class="relative text-gray-600 mt-8 lg:mr-16">
                            <input 
                            x-ref="searchField"
                            x-model="search"
                            x-on:keydown.window.prevent.slash="$refs.searchField.focus()"
                            type="search" name="serch" placeholder="Search" class="bg-white w-full h-10 px-5 rounded-full text-sm focus:outline-none">
                            <button type="submit" class="focus:outline-none absolute right-0 top-0 mt-3 mr-4">
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
                            </svg>
                            </button>
                        </div>

                        </div>
                    </div>
                    <div class="md:w-2/3 py-12 ">
                        <div class="p-4">

                <div class="item px-6 py-6" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-green-400 font-medium' : isOpen == true}" style="color: #ffc600;">¿Venden mandos de control y consolas en Gam.co?</h4>
                        <svg 
                        :class="{'transform rotate-180' : isOpen == true}"
                        class="w-5 h-5 text-gray-500"
                            fill="none" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600' : isOpen == true}">
                        <p>Sí, además de juegos, ofrecemos una amplia gama de mandos de control y consolas para diversas plataformas de juego.</p>
                    </div>
                </div>
                
                <div class="item px-6 py-6" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-green-400 font-medium' : isOpen == true}" style="color: #ffc600;">¿Los mandos y consolas que venden son nuevos o usados?</h4>
                        <svg 
                        :class="{'transform rotate-180' : isOpen == true}"
                        class="w-5 h-5 text-gray-500"
                            fill="none" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600' : isOpen == true}">
                        <p>RTodos nuestros mandos y consolas son nuevos, a menos que se especifique lo contrario en la descripción del producto.</p>
                    </div>
                </div>

                <div class="item px-6 py-6" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-green-400 font-medium' : isOpen == true}" style="color: #ffc600;">¿Cuáles son las marcas disponibles para mandos y consolas en Gam.co?</h4>
                        <svg 
                        :class="{'transform rotate-180' : isOpen == true}"
                        class="w-5 h-5 text-gray-500"
                            fill="none" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600' : isOpen == true}">
                        <p>Trabajamos con una variedad de marcas reconocidas en la industria de los videojuegos, como PlayStation, Xbox, Nintendo, entre otras.</p>
                    </div>
                </div>

                <div class="item px-6 py-6" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-green-400 font-medium' : isOpen == true}" style="color: #ffc600;">¿Ofrecen envíos de mandos y consolas?</h4>
                        <svg 
                        :class="{'transform rotate-180' : isOpen == true}"
                        class="w-5 h-5 text-gray-500"
                            fill="none" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600' : isOpen == true}">
                        <p>Sí, realizamos envíos de mandos de control y consolas a diferentes ubicaciones, según las políticas de envío vigentes.</p>
                    </div>
                </div>

                <div class="item px-6 py-6" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-green-400 font-medium' : isOpen == true}" style="color: #ffc600;">¿Cuánto tiempo tarda en llegar un mando o consola después de realizar la compra?</h4>
                        <svg 
                        :class="{'transform rotate-180' : isOpen == true}"
                        class="w-5 h-5 text-gray-500"
                            fill="none" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600' : isOpen == true}">
                        <p>El tiempo de entrega puede variar según la ubicación y el método de envío seleccionado. Normalmente, se proporcionará esta información al momento de la compra.</p>
                    </div>
                </div>

                <div class="item px-6 py-6" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-green-400 font-medium' : isOpen == true}" style="color: #ffc600;">¿Ofrecen seguimiento de envíos para mandos y consolas?</h4>
                        <svg 
                        :class="{'transform rotate-180' : isOpen == true}"
                        class="w-5 h-5 text-gray-500"
                            fill="none" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600' : isOpen == true}">
                        <p>Sí, proporcionamos información de seguimiento para que puedas rastrear tu paquete una vez que sea despachado.</p>
                    </div>
                </div>

                <div class="item px-6 py-6" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-green-400 font-medium' : isOpen == true}" style="color: #ffc600;">¿Cuáles son las opciones de pago disponibles para comprar mandos, consolas y juegos en Gam.co?</h4>
                        <svg 
                        :class="{'transform rotate-180' : isOpen == true}"
                        class="w-5 h-5 text-gray-500"
                            fill="none" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600' : isOpen == true}">
                        <p>Aceptamos PayPal y transferencias bancarias como métodos de pago seguros para facilitar tus compras.</p>
                    </div>
                </div>

                <div class="item px-6 py-6" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-green-400 font-medium' : isOpen == true}" style="color: #ffc600;">¿Cómo funciona el pago con PayPal en Gam.co?</h4>
                        <svg 
                        :class="{'transform rotate-180' : isOpen == true}"
                        class="w-5 h-5 text-gray-500"
                            fill="none" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600' : isOpen == true}">
                        <p>Durante el proceso de pago, podrás seleccionar PayPal como método de pago. Serás redirigido a la plataforma de PayPal para completar la transacción de forma segura.</p>
                    </div>
                </div>

                <div class="item px-6 py-6" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-green-400 font-medium' : isOpen == true}" style="color: #ffc600;">¿Puedo pagar con transferencia bancaria?</h4>
                        <svg 
                        :class="{'transform rotate-180' : isOpen == true}"
                        class="w-5 h-5 text-gray-500"
                            fill="none" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600' : isOpen == true}">
                        <p>Sí, aceptamos transferencias bancarias como método de pago. Al seleccionar esta opción, te proporcionaremos los detalles bancarios necesarios para completar la transacción.</p>
                    </div>
                </div>

                <div class="item px-6 py-6" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-green-400 font-medium' : isOpen == true}" style="color: #ffc600;">¿Hay algún cargo adicional al utilizar PayPal o transferencia bancaria como método de pago?</h4>
                        <svg 
                        :class="{'transform rotate-180' : isOpen == true}"
                        class="w-5 h-5 text-gray-500"
                            fill="none" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600' : isOpen == true}">
                        <p>No aplicamos cargos adicionales por utilizar PayPal o transferencia bancaria como métodos de pago en Gam.co.</p>
                    </div>
                </div>

                
            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    </article>

    <div
        x-data="scrollHandler(document.getElementById('the-article'))"
        x-cloak
        aria-hidden="true"
        @scroll.window="calculateHeight(window.scrollY)"
        class="fixed h-screen w-1 hover:bg-gray-200 top-0 left-0 bg-gray-300">
        <div :style="`max-height:${height}%`" class="h-full bg-yellow-400" style="color: #ffc600;"></div>
    </div>

    <div
        id="alpine-devtools"
        x-data="devtools()"
        x-show="alpines.length"
        x-init="start()">
    </div>
    <script>
    function scrollHandler(element = null) {
        return {
            height: 0,
            element: element,
            calculateHeight(position) {
                const distanceFromTop = this.element.offsetTop
                const contentHeight = this.element.clientHeight
                const visibleContent = contentHeight - window.innerHeight
                const start = Math.max(0, position - distanceFromTop)
                const percent = (start / visibleContent) * 100;
                requestAnimationFrame(() => {
                    this.height = percent;
                });
            },
            init() {
                this.element = this.element || document.body;
                this.calculateHeight(window.scrollY);
            }
        };
    }

    </script>

    <div style="padding: 100px;"></div>
    <?php include('footer.php'); ?>
</body>
</html>