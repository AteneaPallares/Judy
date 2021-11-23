
@extends('layouts.main')

@section('content')
        <header id="header" class="header ">
        <div class="container ">
            <div class="row ">
                <div class="col-md-6 col-xl-5 col-sm-12 text-center">
                    <div class="pt-5">
                        <h1 class="h1-large">Un romántico sabor</h1>
                        <p class="p-large">Todos tenemos una debilidad por la comida mexicana y es que sus sabores,
                            texturas y aromas son de las más conocidas en el mundo.</p>
                        <h1 class="p-large"> ¡Ven y atrévete a enamorarte de la comida!</h1>
                        <a class="btn-solid-lg" href="#platillos">Platillos</a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xl-7 text-center">
                    <img class="img-fluid" width="60%" src="images/chef.png" alt="alternative">
                </div>
            </div>
        </div>
    </header>
    <div id="details" class="basic-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-7">
                    <div class="image-container">
                        <img class="img-fluid" src="images/restaurante.jpg" alt="alternative">
                    </div>
                </div>
                <div class="col-lg-6 col-xl-5">
                    <div class="text-container">
                        <div class="section-title">¿Qué hacemos?</div>
                        <h2>Es el lugar indicado para enamorarse de la comida mexicana</h2>
                        <p>Nos especializamos en la cocina mexicana, te aseguramos que disfrutarás de la comida con la
                            más alta calidad, además con los estándares más alto de limpieza y con el mejor trato al
                            caliente de la región.</p>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="basic-2" id="aboutd">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5">
                    <div class="text-container">
                        <div class="section-title">Acerca de</div>
                        <h2>Somos un negocio familiar</h2>
                        <p>La compañia de la familia es lo mejor que uno puede tener, mediante esfuerzo y dedicación
                            hemos logrado establecernos. Todo esto empezó desde hace más de 10 años, ahora en la
                            actualidad somos reconocidos como uno de los mejores restaurantes en la zona</p>

                    </div>
                </div>
                <div class="col-lg-6 col-xl-7">
                    <div class="image-container text-center">
                        <img class="img-fluid" src="images/family.png" width="80%" alt="alternative">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="cards-2 bg-gray " id="opinions">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="h2-heading">Opiniones</h2>
                </div>
            </div>
            <div class="row">
                <div >
                    <div class="card">
                        <img class="quotes" src="images/quotes.svg" alt="alternative">
                        <div class="card-body">
                            <p class="testimonial-text">Sinceramente felicito a este restaurante, ya que siempre brinda
                                una excelente atención al consumidor</p>
                            <div class="testimonial-author">Juan Pérez</div>
                            <div class="occupation">Doctor</div>
                        </div>
                        <div class="gradient-floor red-to-blue"></div>
                    </div>
                    <div class="card">
                        <img class="quotes" src="images/quotes.svg" alt="alternative">
                        <div class="card-body">
                            <p class="testimonial-text">La comida de este restaurante es realmente deliciosa y además
                                tiene un ambiente muy agradable</p>
                            <div class="testimonial-author">Luis Gómez</div>
                            <div class="occupation">Mecánico</div>
                        </div>
                        <div class="gradient-floor blue-to-purple"></div>
                    </div>
                    <div class="card">
                        <img class="quotes" src="images/quotes.svg" alt="alternative">
                        <div class="card-body">
                            <p class="testimonial-text">Me gusta que la atención es rápida y de calidad. Además siempre
                                puedo venir en compañia de mi familia</p>
                            <div class="testimonial-author">Martina López</div>
                            <div class="occupation">Vendedor</div>
                        </div>
                        <div class="gradient-floor purple-to-green"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="footer bg-gray">
        <img class="decoration-circles" src="images/decoration-circles.png" alt="alternative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Nos encantaría atenderte para que disfrutes de una comida de excelente calidad. Ven y visitanos,
                        te estamos esperando</h4>

                </div>
            </div>
        </div>
    </div>
    <div class="copyright bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <ul class="list-unstyled li-space-lg p-small">
                        <li>2021</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <p class="p-small statement">Copyright © <a href="#">UnRománticoSabor</a></p>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <p class="p-small statement">Distribuido por un romántico sabor</p>
                </div>
            </div>
        </div>
    </div>
@endsection
