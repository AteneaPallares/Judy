
@extends('layouts.main')

@section('content')
       
    <header class="masthead text-white text-center">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1 class="mb-5">"Somos tu mejor opción para la adquisición de Papel"</h1>
                </div>

            </div>
        </div>
    </header>
    <div id="details" class="basic-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-7">
                    <div class="text-center">
                        <img class="img-fluid w-50"  src="images/dos.jpg" alt="alternative">
                    </div>
                </div>
                <div class="col-lg-6 col-xl-5">
                    <div class="text-container">
                        <div class="section-title">¿Qué hacemos?</div>
                        <h2>Es el lugar indicado para adquirir el papel con una excelente calidad y a un buen precio.</h2>
                        <p>Nos especializamos en la distribución de cualquier tipo de papel utilizado para el hogar y empresa, desde la cartulina hasta el papel fotográfico .</p>

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
                            <p class="testimonial-text">Sinceramente felicito a esta distribuidora, ya que siempre brinda
                                una excelente atención al cliente</p>
                            <div class="testimonial-author">Juan Pérez</div>
                            <div class="occupation">Doctor</div>
                        </div>
                        <div class="gradient-floor red-to-blue"></div>
                    </div>
                    <div class="card">
                        <img class="quotes" src="images/quotes.svg" alt="alternative">
                        <div class="card-body">
                            <p class="testimonial-text">La productos de esta papelera son de calidad y además
                                las entregas siempre son a tiempo.</p>
                            <div class="testimonial-author">Luis Gómez</div>
                            <div class="occupation">Mecánico</div>
                        </div>
                        <div class="gradient-floor blue-to-purple"></div>
                    </div>
                    <div class="card">
                        <img class="quotes" src="images/quotes.svg" alt="alternative">
                        <div class="card-body">
                            <p class="testimonial-text">Me gusta que la atención es rápida. Además siempre
                                puedo abastecerme de productos a un precio justo.</p>
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
                    <h4>Nos encantaría atenderte para que disfrutes de una servicio de excelente calidad. Ven y visitanos,
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
                    <p class="p-small statement">Copyright © <a href="#">Judy</a></p>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <p class="p-small statement">Distribuido por Judy</p>
                </div>
            </div>
        </div>
    </div>
@endsection
