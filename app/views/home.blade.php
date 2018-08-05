@extends('layouts/home')
@section('content')
    <!-- ====== Menu Section ====== -->
    <section id="menu">
        <div class="navigation">
            <div id="main-nav" class="navbar navbar-default" role="navigation">
                <div class="container">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">MENU</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div> <!-- end .navbar-header -->

                    <div class="navbar-collapse collapse">
                        <ul id="ulnav" class="nav navbar-nav navbar-right">
                            <li class="active"><a href="#top">Inicio</a></li>
                            <li><a href="#screenshots">Reportes</a></li>
                            <li><a href="#description">Servicios</a></li>
                            <li><a href="#price">Cobertura</a></li>
                            <li><a href="#team">Clientes</a></li>
                            <li><a href="#download">Contacto</a></li>
                        </ul>

                    </div><!-- end .navbar-collapse -->
                </div> <!-- end .container -->
            </div> <!-- end #main-nav -->
        </div> <!-- end .navigation -->
    </section>
    <!-- ====== End Menu Section ====== -->
    <!-- ====== Header Section ====== -->
    <header id="top">
        <div class="bg-color">
            <div class="top section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-sm-7 col-md-7">
                            <div class="content">
                                <h1><strong>TT Audit</strong><br>AUDITORIA DE PUNTO DE VENTA</h1>
                                <h2>Investigación y Control de Puntos de Venta</h2>

                                @if (Auth::check())
                                    @if (Auth::user()->type=='auditor')
                                        {{Redirect::to('auditor');}}
                                    @endif
                                    @if (Auth::user()->type=='admin')
                                        {{ Redirect::to('admin/panel'); }}
                                    @endif
                                    @if ((Auth::user()->type=='company') or (Auth::user()->type=='executive'))
                                        @if (Auth::user()->userCompany[count(Auth::user()->userCompany)-1]->company->customer_id == 5)
                                            {{ Redirect::to('reportBayer'); }}
                                        @endif
                                        @if (Auth::user()->userCompany[count(Auth::user()->userCompany)-1]->company->customer_id == 4)
                                            {{ Redirect::to('reportAlicorp'); }}
                                        @endif
                                        @if (Auth::user()->userCompany[count(Auth::user()->userCompany)-1]->company->customer_id == 1)
                                            {{ Redirect::to('report'); }}
                                        @endif

                                    @endif
                                @else
                                    {{ Form::open(['route' => 'login', 'method' => 'POST', 'role' => 'form', 'class' => '']) }}
                                    @if (Session::has('login_error'))
                                        <span class="label label-danger">Credenciales NO válidas</span>
                                    @endif
                                    Acceso Clientes:
                                    <div class="controles">
                                        <div class="form-group">
                                            <span class="icon-user"></span>
                                            {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'EMAIL']) }}
                                        </div>
                                        <div class="form-group">
                                            <span class="icon-llave"></span>
                                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'PASSWORD']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="remember-me">
                                            {{ Form::checkbox('remember') }} Recordarme
                                        </label>
                                    </div>
                                    <input type="submit" class="btn btn-default left-block" value="INGRESAR"/>
                                    {{ Form::close() }}
                                @endif

                            </div> <!-- end .content -->
                        </div> <!-- end .top > .container> .row> .col-md-7 -->

                        <div class="col-sm-5 col-md-5">
                            <div class="photo-slide">
                                <div id="carousel" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel" data-slide-to="1" class=""></li>
                                        <li data-target="#carousel" data-slide-to="2" class=""></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="item">
                                            <img src="home/images/phone1.png" alt="">
                                        </div>
                                        <div class="item active left">
                                            <img src="home/images/phone2.png" alt="">
                                        </div>
                                        <div class="item next left">
                                            <img src="home/images/phone3.png" alt="">
                                        </div>
                                    </div> <!-- end .carousel-inner -->
                                </div> <!-- end #carousel -->
                            </div> <!-- end .photo-slide -->
                        </div> <!-- end .top > .container> .row> .col-md-5 -->

                    </div> <!-- end .top> .container> .row -->
                </div> <!-- end .top> .container -->
            </div> <!-- end .top -->
        </div> <!-- end .bg-color -->
    </header>
    <!-- ====== End Header Section ====== -->

    <!-- ====== Features Section ====== -->
    <section id="features">
        <div class="features section-padding">
            <div class="container">

                <div class="header">
                    <h1>Información en tiempo real</h1>
                    <p>A través de una red de auditores distribuida en todo el territorio nacional y un equipo profesional de investigación, que apoyados en la más alta tecnología móvil, trabajan personalizando y optimizando la plataforma para comprobar las hipótesis específicas de su investigación.</p>
                    <div class="underline">
                        <i class="fa fa-certificate"></i>
                    </div>
                </div> <!-- end .container> .header -->

                <div class="row">
                    <div class="col-md-4">
                        <div class="featured-item-img">
                            <img src="home/images/phone1.png" alt="">
                        </div>
                    </div>
                    <div class="col-md-8 feature-list">
                        <div class="row">

                            <div class="col-sm-6 col-md-6">
                                <div class="featured-item">
                                    <div class="icon">
                                        <div class="icon-style"><i class="fa fa-map-marker"></i></div>
                                    </div> <!-- end icon -->
                                    <div class="meta-text">
                                        <h3>Más puntos de venta en menos tiempo</h3>
                                        <p>Sistema de Inteligente de Optimización de Rutas.</p>
                                    </div> <!-- end .meta-text -->
                                </div> <!-- end .featured-item -->
                            </div> <!-- end .feature-list> .row > .col-md-6 (1st item) -->

                            <div class="col-sm-6 col-md-6">
                                <div class="featured-item">
                                    <div class="icon">
                                        <div class="icon-style"><i class="fa fa-camera"></i></div>
                                    </div> <!-- end icon -->
                                    <div class="meta-text">
                                        <h3>Archivo fotográfico</h3>
                                        <p>Seguimiento y archivo detallado de todo el proceso de recolección de información.</p>
                                    </div> <!-- end .meta-text -->
                                </div> <!-- end .featured-item -->
                            </div> <!-- end .feature-list> .row > .col-md-6 (2nd item) -->

                            <div class="col-sm-6 col-md-6">
                                <div class="featured-item">
                                    <div class="icon">
                                        <div class="icon-style"><i class="fa fa-file"></i></div>
                                    </div> <!-- end icon -->
                                    <div class="meta-text">
                                        <h3>Reportes en linea</h3>
                                        <p>Acceso seguro y en tiempo real al avance y resultados generales del estudio.</p>
                                    </div> <!-- end .meta-text -->
                                </div> <!-- end .featured-item -->
                            </div> <!-- end .feature-list> .row > .col-md-6 (3rd item) -->

                            <div class="col-sm-6 col-md-6">
                                <div class="featured-item">
                                    <div class="icon">
                                        <div class="icon-style"><i class="fa fa-gears"></i></div>
                                    </div> <!-- end icon -->
                                    <div class="meta-text">
                                        <h3>Flexibilidad y Personalización</h3>
                                        <p>Todos los reportes y metodologías son adaptadas a las necesidades específicas de su negocio.</p>
                                    </div> <!-- end .meta-text -->
                                </div> <!-- end .featured-item -->
                            </div> <!-- end .feature-list> .row > .col-md-6 (4th item) -->

                            <div class="col-sm-6 col-md-6">
                                <div class="featured-item">
                                    <div class="icon">
                                        <div class="icon-style"><i class="fa fa-users"></i></div>
                                    </div> <!-- end icon -->
                                    <div class="meta-text">
                                        <h3>Red de Auditores</h3>
                                        <p>Más de 100 auditores profesionales y capacitados en nuestra metodología y herramientas en todo el Perú.</p>
                                    </div> <!-- end .meta-text -->
                                </div> <!-- end .featured-item -->
                            </div> <!-- end .feature-list> .row > .col-md-6 (5th item) -->

                            <div class="col-sm-6 col-md-6">
                                <div class="featured-item">
                                    <div class="icon">
                                        <div class="icon-style"><i class="fa fa-briefcase"></i></div>
                                    </div> <!-- end icon -->
                                    <div class="meta-text">
                                        <h3>Experiencia</h3>
                                        <p>Equipo con más de 15 años de experiencia en la investigación y ejecución en campañas de retail a nivel nacional.</p>
                                    </div> <!-- end .meta-text -->
                                </div> <!-- end .featured-item -->
                            </div> <!-- end .feature-list> .row > .col-md-6 (6th item) -->
                        </div> <!-- end .feature-list> .row -->
                    </div> <!-- end .feature-list -->
                </div> <!-- end .container> .row -->
            </div> <!-- end .container -->
        </div> <!-- end .features -->
    </section>
    <!-- ====== End Features Section ====== -->


    <!-- ====== Screenshots Section ====== -->
    <section id="screenshots">
        <div class="screenshots section-padding dark-bg">
            <div class="container">

                <div class="header">
                    <h1>Reportes Personalizados</h1>
                    <p>Trabajamos junto con el cliente en la adaptación y personalización de los reportes de resultados para ajustarlos a las necesidades especificas de su negocio.</p>
                    <div class="underline"><i class="fa fa-table"></i></div>
                </div>

                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <a href="home/images/app.jpg" data-rel="prettyPhoto"><img src="home/images/app.jpg" alt="item photo"></a>
                    </div> <!-- end item -->
                    <div class="item">
                        <a href="home/images/app2.jpg" data-rel="prettyPhoto"><img src="home/images/app2.jpg" alt="item photo"></a>
                    </div> <!-- end item -->
                    <div class="item">
                        <a href="home/images/app3.jpg" data-rel="prettyPhoto"><img src="home/images/app3.jpg" alt="item photo"></a>
                    </div> <!-- end item -->
                    <div class="item">
                        <a href="home/images/app4.jpg" data-rel="prettyPhoto"><img src="home/images/app4.jpg" alt="item photo"></a>
                    </div> <!-- end item -->
                    <div class="item">
                        <a href="home/images/app5.jpg" data-rel="prettyPhoto"><img src="home/images/app5.jpg" alt="item photo"></a>
                    </div> <!-- end item -->
                    <div class="item">
                        <a href="home/images/app6.jpg" data-rel="prettyPhoto"><img src="home/images/app6.jpg" alt="item photo"></a>
                    </div> <!-- end item -->
                </div> <!-- end owl carousel -->

            </div> <!-- .container -->
        </div> <!-- end .screenshots -->
    </section>
    <!-- ====== End Screenshots Section ====== -->

    <!-- ====== Description Section ====== -->
    <section id="description">
        <div class="description">
            <div class="description-two section-padding -bg">
                <div class="container">
                    <div class="row">

                        <div class="col-sm-7 col-md-6">
                            <div class="content">
                                <h1>Control de Ejecución, Información y Análisis</h1>

                                <ul class="list-item">
                                    <li><i class="fa fa-thumbs-o-up"></i> Visibilidad de Marca y Marcado de Precios</li>
                                    <li><i class="fa fa-thumbs-o-up"></i> Inversión PTO de Venta y Material POP</li>
                                    <li><i class="fa fa-thumbs-o-up"></i> Capacitación en Servicios y Cliente Incognito</li>
                                    <li><i class="fa fa-thumbs-o-up"></i> Distribución Numérica y Ponderada</li>
                                    <li><i class="fa fa-thumbs-o-up"></i> Nivel de Inventarios</li>
                                    <li><i class="fa fa-thumbs-o-up"></i> Promotoría de Ventas</li>

                                </ul>
                            </div> <!-- end .content -->
                        </div> <!-- .container> .row> .col-md-6 -->

                        <div class="col-sm-5 col-md-6">
                            <div class="app-image">
                                <img class="img-responsive" src="home/images/duel-phone-big.png" alt="">
                            </div> <!-- end .app-image -->
                        </div> <!-- .container> .row> .col-md-6 -->

                    </div> <!-- .container> .row -->
                </div> <!-- .container -->
            </div> <!-- end .description-two -->

        </div> <!-- end .description -->
    </section>
    <!-- ====== End Description Section ====== -->


    <!-- ====== Price Section ====== -->
    <section id="price">
        <div class="price section-padding dark-bg">
            <div class="container">

                <div class="header">
                    <h1>Cobertura en todo el Perú</h1>
                    <p>Contamos con una red propia de auditores profesionales distribuidos por todo el territorio nacional.</p>
                    <div class="underline"><i class="fa fa-certificate"></i></div>
                </div> <!-- end .container> .header -->

                <div class="row">
                    <div class="price-list">
                        <div class="col-md-4">
                            <div class="price-table">
                                <h2>Canal Tradicional</h2>
                                <ul>
                                    <li><i class="fa fa-check"></i>Bodegas</li>
                                    <li><i class="fa fa-check"></i>Mercados</li>
                                    <li><i class="fa fa-check"></i>Mayoristas</li>
                                    <li><i class="fa fa-check"></i>Kioskos</li>
                                    <li><i class="fa fa-check"></i>Cruceristas</li>
                                </ul>
                            </div> <!-- end .price-table -->
                        </div> <!-- end .price-list> .col-md-4 (1) -->

                        <div class="col-md-4">
                            <div class="price-table featured-price">
                                <h2>Canal Moderno</h2>
                                <ul>
                                    <li><i class="fa fa-check"></i>Autoservicios</li>
                                    <li><i class="fa fa-check"></i>Cadenas de Farmacias</li>
                                    <li><i class="fa fa-check"></i>Estaciones de Servicio</li>
                                </ul>
                            </div> <!-- end .price-table -->
                        </div> <!-- end .price-list> .col-md-4 (2) -->

                        <div class="col-md-4">
                            <div class="price-table">
                                <h2>Otros Canales</h2>
                                <ul>
                                    <li><i class="fa fa-check"></i>Agentes Bancarios</li>
                                    <li><i class="fa fa-check"></i>Farmacias</li>
                                    <li><i class="fa fa-check"></i>Panaderias</li>
                                    <li><i class="fa fa-check"></i>Ferreterias</li>
                                </ul>
                            </div> <!-- end .price-table -->
                        </div> <!-- end .price-list> .col-md-4 (3) -->
                    </div> <!-- end .price-list -->
                </div> <!-- end .container> .row -->

            </div> <!-- end .container -->
        </div> <!-- end .price -->
    </section>
    <!-- ====== End Price Section ====== -->
    <!-- ====== Team Section ====== -->
    <section id="team">
        <div class="team section-padding">
            <div class="container">

                <div class="header">
                    <h1>Nuestros Clientes</h1>
                </div> <!-- end .container> .header -->

                <div class="row">
                    <div class="app-dev">

                        <div class="col-sm-6 col-md-6 col-lg-3 info">
                            <div class="member">
                                <img src="home/images/01.jpg" alt="">
                            </div> <!-- end .member -->
                        </div> <!-- end .info (1) -->

                        <div class="col-sm-6 col-md-6 col-lg-3 info">
                            <div class="member">
                                <img src="home/images/02.jpg" alt="">
                            </div> <!-- end .member -->
                        </div> <!-- end .info (2) -->

                        <div class="col-sm-6 col-md-6 col-lg-3 info">
                            <div class="member">
                                <img src="home/images/03.jpg" alt="">
                            </div> <!-- end .member -->
                        </div> <!-- end .info (3) -->

                        <div class="col-sm-6 col-md-6 col-lg-3 info">
                            <div class="member">
                                <img src="home/images/04.jpg" alt="">
                            </div> <!-- end .member -->
                        </div> <!-- end .info (3) -->

                        <div class="col-sm-6 col-md-6 col-lg-3 info">
                            <div class="member">
                                <img src="home/images/05.jpg" alt="">
                            </div> <!-- end .member -->
                        </div> <!-- end .info (3) -->

                        <div class="col-sm-6 col-md-6 col-lg-3 info">
                            <div class="member">
                                <img src="home/images/06.jpg" alt="">
                            </div> <!-- end .member -->
                        </div> <!-- end .info (4) -->

                    </div> <!-- end .app-dev -->
                </div> <!-- end .container> .row -->

            </div> <!-- end .container -->
        </div> <!-- end .team -->
    </section>
    <!-- ====== Team Section ====== -->
    <!-- ====== Download Section ====== -->
    <section id="download">
        <div class="bg-color">
            <div class="download section-padding">
                <div class="container">
                    <div class="header">
                        <h1>Contacto</h1>
                        <div class="underline"><i class="fa fa-home"></i></div>
                        <h3>Traditional Trade Audit SAC<br>
                            Saenz Peña 109, Barranco - Lima, Peru.</h3><br>
                        <h3>ellerena@ttaudit.com</h3>
                        <h1> <i class="fa fa-phone"> </i>  (511) 487 8757</h1>
                    </div> <!-- end .container > .header -->
                </div> <!-- end .container > .row/.download-area -->
            </div>
        </div> <!-- end .container -->
    </section>
    <!-- ====== End Download Section ====== -->

    <!-- ====== Copyright Section ====== -->
    <section class="copyright dark-bg">
        <div class="container">
            <p>&copy; 2017 | TT Audit</p>
        </div> <!-- end .container -->
    </section>
    <!-- ====== End Copyright Section ====== -->
@stop