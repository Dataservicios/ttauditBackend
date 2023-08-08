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
                        <div class="logo">TT Audit</div>
                        <ul id="ulnav" class="nav navbar-nav navbar-right">
                            <li >
                                <a href="#puntosdeventa" id="bt-reportes">Puntos de venta</a>
                            </li>
                            <li>
                                <a href="#horeca" id="bt-horeca">HORECA</a>
                            </li>
                            <li>
                                <a href="#canalesdeventa" id="bt-servicios">Canales de Venta</a>
                            </li>
                            <li>
                                <a href="#plataforma" id="bt-cobertura">Plataforma</a>
                            </li>
                            <li><a href="#clientes" id="bt-clientes">Clientes</a></li>
                            <li><a href="#contacto" id="bt-contacto">Contacto</a></li>
                            <li class="active">
                                <a href="#top" id="bt-inicio">Login</a>
                            </li>
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
                                <h1><strong>TT Audit</strong><br>AUDITORÍA Y EJECUCIONES DE TRADE
                                    MARKETING</h1>
                                <h2>con herramientas tecnológicas y análisis en tiempo real</h2>
                                @if (Auth::check())
                                    @if (Auth::user()->type=='auditor')
                                        {{Redirect::to('auditor')}}
                                    @endif
                                    @if (Auth::user()->type=='admin')
                                        {{ Redirect::to('admin/panel') }}
                                    @endif
                                    @if ((Auth::user()->type=='company') or (Auth::user()->type=='executive'))
                                        @if (Auth::user()->userCompany[count(Auth::user()->userCompany)-1]->company->customer_id == 5)
                                            {{ Redirect::to('reportBayer') }}
                                        @endif
                                        @if (Auth::user()->userCompany[count(Auth::user()->userCompany)-1]->company->customer_id == 4)
                                            {{ Redirect::to('reportAlicorp') }}
                                        @endif
                                        @if (Auth::user()->userCompany[count(Auth::user()->userCompany)-1]->company->customer_id == 1)
                                            {{ Redirect::to('report') }}
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
                                            <img src="home/images/fono1.png" alt="">
                                        </div>
                                        <div class="item active left">
                                            <img src="home/images/fono2.png" alt="">
                                        </div>
                                        <div class="item next left">
                                            <img src="home/images/fono3.png" alt="">
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
                    <h1>TT AUDIT EN NÚMEROS</h1>

                    <div class="underline">
                        <i class="fa fa-certificate"></i>
                    </div>
                </div>
                <!-- end .container> .header -->

                <div class="row">
                    <div class="col-md-4">
                        <img
                                src="home/images/001-dashboard.png"
                                alt="Datos procesados al mes"
                        />
                        <h2>500,000+</h2>
                        <p>DATOS PROCESADOS<br />AL MES.</p>
                    </div>
                    <div class="col-md-4">
                        <img
                                src="home/images/002-camera.png"
                                alt="REGISTROS FOTOGRÁFICOS RELEVADOS"
                        />
                        <h2>50,000+</h2>
                        <p>REGISTROS FOTOGRÁFICOS<br />RELEVADOS.</p>
                    </div>
                    <div class="col-md-4">
                        <img src="home/images/003-shop.png" alt="VISITAS A PDV MENSUALES" />
                        <h2>10,000+</h2>
                        <p>VISITAS A<br />PDV MENSUALES.</p>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-4">
                        <img
                                src="home/images/004-update.png"
                                alt="APLICATIVOS DESARROLLADOS PARA DIFERENTES SERVICIOS."
                        />
                        <h4>TIEMPO REAL:</h4>
                        <h2 class="sinmt">+200</h2>
                        <p>APLICATIVOS DESARROLLADOS PARA DIFERENTES SERVICIOS.</p>
                    </div>
                    <div class="col-md-4">
                        <img src="home/images/005-peru.png" alt="COBERTURA NN: +100" />
                        <h4>COBERTURA NN:</h4>
                        <h2 class="sinmt">+100</h2>
                        <p>COLABORADORES EN TODAS<br />LAS CIUDADES DEL PERÚ.</p>
                    </div>
                    <div class="col-md-4">
                        <img src="home/images/006-group.png" alt="BACK OFFICE: +20" />
                        <h4>BACK OFFICE</h4>
                        <h2 class="sinmt">+20</h2>
                        <p>CONSOLIDANDO DATA Y<br />DESARROLLANDO INDICADORES.</p>
                    </div>
                </div>

                <!-- end .container> .row -->
            </div>
            <!-- end .container -->
        </div>
        <!-- end .features -->
    </section>
    <!-- ====== End Features Section ====== -->

    <!-- ====== Puntos de Venta Section ====== -->
    <section id="puntosdeventa">
        <div class="screenshots section-padding dark-bg">
            <div class="container">
                <div class="row">
                    <!-- .container> .row> .col-md-6 -->

                    <div class="col-sm-5 col-md-6">
                        <div class="app-image">
                            <img
                                    class="img-responsive"
                                    src="home/images/punto-de-venta.png"
                                    alt=""
                            />
                        </div>
                        <!-- end .app-image -->
                    </div>
                    <!-- .container> .row> .col-md-6 -->

                    <div class="col-sm-7 col-md-6">
                        <div class="content">
                            <h1>Puntos de Venta Canal Tradicional</h1>

                            <ul class="list-item">
                                <li>
                                    <i class="fa fa-check"></i>
                                    <strong
                                    >Auditoría de Fundamentales de Trade Marketing:</strong
                                    ><br />
                                    Presencia de Producto y/o Surtido Ideal (OSA), Visibilidad
                                    de Marca, Material POP, Chequeo de Precios.
                                </li>
                                <li>
                                    <i class="fa fa-check"></i>
                                    <strong>Auditoría de Servicios:</strong><br />
                                    Recomendación y Conocimiento de Marca – Promociones
                                    (Modalidad Cliente Incógnito).
                                </li>
                                <li>
                                    <i class="fa fa-check"></i>
                                    <strong>Auditoría de Planes de Fidelización.</strong>
                                </li>
                                <li>
                                    <i class="fa fa-check"></i>
                                    <strong>Ejecuciones de Trade Marketing:</strong
                                    ><br />Promotoría, Mercaderismo, Autoventa/Transferencistas,
                                    Siembra de Productos, Instalación y Ejecución de Material
                                    POP, BTL.
                                </li>
                            </ul>
                        </div>
                        <!-- end .content -->
                    </div>
                </div>
                <!-- .container> .row -->
            </div>
            <!-- .container -->
        </div>
        <!-- end .screenshots -->
    </section>
    <!-- ====== End Puntos de Venta Section ====== -->

    <!-- ====== Horeca Section ====== -->
    <section id="horeca">
        <div class="screenshots section-padding dark-bg">
            <div class="container">
                <div class="row">
                    <!-- .container> .row> .col-md-6 -->

                    <div class="col-sm-7 col-md-6">
                        <div class="content">
                            <h1>Ejecuciones de Trade Marketing HORECA</h1>

                            <ul class="list-item">
                                <li>
                                    <i class="fa fa-check"></i>
                                    <strong>Gestión de Venta:</strong><br />
                                    MVP (Producto Mínimo Viable), Sell Sampling, Autoventa,
                                    Venta Cruzada, Telemarketing, Promotoría de Venta.
                                </li>
                                <li>
                                    <i class="fa fa-check"></i>
                                    <strong>Servicio de Mercaderismo.</strong>
                                </li>
                                <li>
                                    <i class="fa fa-check"></i>
                                    <strong>Prueba de producto – Demostraciones.</strong>
                                </li>
                            </ul>
                        </div>
                        <!-- end .content -->
                    </div>

                    <div class="col-sm-5 col-md-6">
                        <div class="app-image">
                            <img
                                    class="img-responsive"
                                    src="home/images/punto-de-venta.png"
                                    alt=""
                            />
                        </div>
                        <!-- end .app-image -->
                    </div>
                    <!-- .container> .row> .col-md-6 -->
                </div>
                <!-- .container> .row -->
            </div>
            <!-- .container -->
        </div>
        <!-- end .screenshots -->
    </section>
    <!-- ====== End Horeca Section ====== -->

    <!-- ====== Canales Section ====== -->
    <section id="canalesdeventa">
        <div class="description">
            <div class="description-two section-padding -bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-5">
                            <div class="content">
                                <h1>Gestión en Canales de Venta</h1>

                                <ul class="list-item">
                                    <li>
                                        <i class="fa fa-check"></i>
                                        <strong
                                        >Gestión de Información en Distribuidores No Exclusivos
                                            y Mayoristas:</strong
                                        ><br />Sell Out, Cobertura, Stock, Indicadores por
                                        Vendedor, Ticket Promedio, Profundidad de Pedidos.
                                    </li>
                                    <li>
                                        <i class="fa fa-check"></i>
                                        <strong
                                        >Seguimiento y Premiación de Concursos a FFVV.</strong
                                        >
                                    </li>
                                    <li>
                                        <i class="fa fa-check"></i>
                                        <strong>Información Actividades Competencia.</strong>
                                    </li>
                                    <li>
                                        <i class="fa fa-check"></i>
                                        <strong>Ruta al Mercado:</strong><br />Márgenes, FFVV,
                                        Oferta de valor.
                                    </li>
                                </ul>
                            </div>
                            <!-- end .content -->
                        </div>
                        <!-- .container> .row> .col-md-6 -->

                        <div class="col-sm-6 col-md-7">
                            <div class="app-image">
                                <img
                                        class="img-responsive"
                                        src="home/images/gestion-ventas.jpg"
                                        alt=""
                                />
                            </div>
                            <!-- end .app-image -->
                        </div>
                        <!-- .container> .row> .col-md-6 -->
                    </div>
                    <!-- .container> .row -->
                </div>
                <!-- .container -->
            </div>
            <!-- end .description-two -->
        </div>
        <!-- end .description -->
    </section>
    <!-- ====== End Canales Section ====== -->

    <!-- ====== Plataforma Section ====== -->
    <section id="plataforma">
        <div class="price section-padding">
            <div class="container">
                <!-- end .container> .header -->
                <div class="row">
                    <div class="col-md-7">
                        <img
                                src="home/images/plataforma-tec.jpg"
                                alt="Plataforma Tecnologica"
                        />
                    </div>
                    <div class="col-md-5">
                        <h1>Consultoría de Comunicaciones</h1>
                        <ul>
                            <li>
                                <i class="fa fa-check"></i>
                                <strong>Plataforma Tecnológica </strong>
                            </li>
                            <li>
                                <i class="fa fa-check"></i>
                                <strong
                                >Desarrollo de aplicativos móviles y entornos web para el
                                    análisis de información en tiempo real.
                                </strong>
                            </li>
                            <li>
                                <i class="fa fa-check"></i>
                                <strong
                                >Medición de visibilidad en entorno web.
                                </strong>
                            </li>
                            <li>
                                <i class="fa fa-check"></i>
                                <strong
                                >Reportes a medida del cliente en Power BI y Web.</strong
                                >
                            </li>
                            <li>
                                <i class="fa fa-check"></i>
                                <strong>Estrategias de comunicación multicanal. </strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end .container -->
        </div>
        <!-- end .price -->
    </section>
    <!-- ====== End Plataforma Section ====== -->

    <!-- ====== Team Section ====== -->
    <section id="clientes">
        <div class="team section-padding dark-bg">
            <div class="container">
                <div class="header">
                    <h1>Nuestros Clientes</h1>
                </div>
                <!-- end .container> .header -->

                <div class="row">
                    <div class="app-dev">
                        <div class="col-sm-6 col-md-4 info">
                            <div class="member">
                                <img src="home/images/alicorp.jpg" alt="Alicorp" />
                            </div>
                            <!-- end .member -->
                        </div>
                        <!-- end .info (1) -->

                        <div class="col-sm-6 col-md-4 info">
                            <div class="member">
                                <img src="home/images/logo-gloria.jpg" alt="Gloria" />
                            </div>
                            <!-- end .member -->
                        </div>
                        <!-- end .info (2) -->

                        <div class="col-sm-6 col-md-4 info">
                            <div class="member">
                                <img src="home/images/logo-molitalia.jpg" alt="Molitalia" />
                            </div>
                            <!-- end .member -->
                        </div>
                        <!-- end .info (3) -->
                    </div>
                    <!-- end .app-dev -->
                </div>
                <!-- end .container> .row -->

                <div class="row">
                    <div class="app-dev">
                        <div class="col-sm-6 col-md-4 info">
                            <div class="member">
                                <img src="home/images/01.jpg" alt="Bayer" />
                            </div>
                            <!-- end .member -->
                        </div>
                        <!-- end .info (3) -->

                        <div class="col-sm-6 col-md-4 info">
                            <div class="member">
                                <img src="home/images/unilever-food.jpg" alt="Unilever" />
                            </div>
                            <!-- end .member -->
                        </div>
                        <!-- end .info (1) -->

                        <div class="col-sm-6 col-md-4 info">
                            <div class="member">
                                <img
                                        src="home/images/alicorp-soluciones.jpg"
                                        alt="Alicorp Soluciones"
                                />
                            </div>
                            <!-- end .member -->
                        </div>
                        <!-- end .info (2) -->
                    </div>
                    <!-- end .app-dev -->
                </div>
                <!-- end .container> .row -->

                <div class="row">
                    <div class="app-dev">
                        <div class="col-sm-6 col-md-4 info">
                            <div class="member">
                                <img src="home/images/pepsicologo.jpg" alt="Pepsico" />
                            </div>
                            <!-- end .member -->
                        </div>
                        <!-- end .info (3) -->

                        <div class="col-sm-6 col-md-4 info">
                            <div class="member">
                                <img src="home/images/interbank.jpg" alt="Interbank" />
                            </div>
                            <!-- end .member -->
                        </div>
                        <!-- end .info (3) -->

                        <div class="col-sm-6 col-md-4 info">
                            <div class="member">
                                <img src="home/images/palmera-logo.jpg" alt="Palmera" />
                            </div>
                            <!-- end .member -->
                        </div>
                        <!-- end .info (2) -->
                    </div>
                    <!-- end .app-dev -->
                </div>
                <!-- end .container> .row -->
            </div>
            <!-- end .container -->
        </div>
        <!-- end .team -->
    </section>
    <!-- ====== Team Section ====== -->
    <!-- ====== Download Section ====== -->
    <section id="contacto">
        <div class="bg-color">
            <div class="download section-padding">
                <div class="container">
                    <div class="header">
                        <h1>Contacto</h1>
                        <div class="underline"><i class="fa fa-home"></i></div>
                        <p>
                            <strong>Raúl Pulido</strong><br />
                            Director de Cuentas<br />
                            <a href="mailto:rpulido@ttaudit.com">rpulido@ttaudit.com</a
                            ><br />
                            Av. Almirante Miguel Grau 629 Oficina 506, Barranco.
                        </p>

                        <p><i class="fa fa-phone"> </i> (51) 977 828 194</p>
                    </div>
                    <!-- end .container > .header -->
                </div>
                <!-- end .container > .row/.download-area -->
            </div>
        </div>
        <!-- end .container -->
    </section>
    <!-- ====== End Download Section ====== -->

    <!-- ====== Copyright Section ====== -->
    <section class="copyright dark-bg">
        <div class="container">
            <p>&copy; 2020 | TT Audit</p>
        </div> <!-- end .container -->
    </section>
    <!-- ====== End Copyright Section ====== -->
@stop