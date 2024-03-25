<script setup>
const bg_ver = VerificacionE();
</script>
<template>
<div class="container-fluid ">
    <div class="row ">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="ms-5 col-md-8 offset-md-4 ">
                <Filter></Filter>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mb-5 my-auto "  >
                    <div class="row" >
                        <div class="col-sm col-0 "></div>
                              <div class="col-sm-9 col-12 " >
                                <div class="row justify-content-center  fondo_bg"  :class="{ 'main_pc_cover_blue': bg_ver.isChecked }" >
                                    <!-- esto es lo del pagination -->
                                    <div class="col-xl-3 col-6 mt-3 mb-3 me-0 d-flex justify-content-center " >
                                        <div class="base_exp " >
                                            <div class="exp_7 ">
                                            <button type="button" class="  forma d-flex  mt-2 ms-2  exp_8"  data-bs-toggle="modal" data-bs-target="1" >
                                                <div class="contenido-icono  ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                    </svg>
                                                </div>
                                            </button>
                                            <a >
                                                <img src="../assets/81tE1x6OmQL._AC_UF894,1000_QL80_.jpg" width="213.5px" height="305.44px" class=" exp_9 prueba-3 prueba-hoover cambio-cero rounded">
                                            </a>
                                            </div>
                                        </div>
                                        <!--nueva en modal-->
                                        <div class="modal fade" id="1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                            <div class="modal-body">
                                                <div class="container-fluid" >

                                                <div class="row">


                                                    <div class="col-sm-auto  d-flex justify-content-center" >
                                                    <img src="../assets/81tE1x6OmQL._AC_UF894,1000_QL80_.jpg" width="320" height="450" >

                                                    </div>

                                                    <div class="col-sm-6  " >
                                                        <div class="row mt-5 mb-5" >



                                                        <div class="col mb-0 mt-0 prueba-de-movimiento " >

                                                            <a class="sujeto">titulo</a>

                                                        </div>



                                                        </div>
                                                        <div class="row mt-5 mb-5" style="border: 0px solid rgb(25, 181, 189);">
                                                        <div class="col mb-0 mt-0" style="border: 0px solid rgb(66, 41, 41);">
                                                            <a>Konami</a>
                                                        </div>
                                                        </div>

                                                        <div class="row  mt-3 " >
                                                        <div class="col-6   mt-sm-5 mb-sm-5  " >
                                                            <div class="btn-group-vertical"  role="group" aria-label="Vertical button group">
                                                            <button type="button" class="btn btn-danger ">genero1</button>
                                                            <button type="button" class="btn btn-dark">genero2</button>
                                                            <button type="button" class="btn btn-danger ">genero2</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 mt-sm-3 mb-sm-3 " >

                                                            <div class="final mt-1 ms-2">
                                                                <a class="calificacion-1 mt-4"> Calificacion: </a>
                                                                <a class="nota mt-2">calificacion</a>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                </div>

                                            </div>
                                            <div class="modal-footer d-flex justify-content-center" >
                                            <a ><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ir a la reseña</button></a>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- fin de lo de pagination -->
                                    </div>
                                </div>
                            <div class="col-sm col-0 "></div>
                      
                            </div>
                            <div class="col-sm col-0 "></div>

                    </div>
</div>
</template>
<style scoped>
.fondo_bg{
    /* background: #151f2b ; */
    background: rgb(209, 194, 194);
    border-radius: 5px;
}

.fondo{
    background-color: #151f2b !important;
    border-radius: 15px;
    border-bottom: 1px solid white;
}


.circulo{

    height:25px;
    width:25px;

    -moz-border-radius:50px;
    -webkit-border-radius:50px;
    border-radius:50px;
}



/*visibilidad del sugerir y reseñar*/








.buton{

    border-radius: 5px;
}
.pies{

    background: #151f2b !important;
    display: block !important;
    
    width: 100%;
 
    

}
.color{
    background-color: white;
    color: rgb(52, 143, 213);
}

.toque:hover{
    background-color: rgb(103, 254, 171);

    
}
.fondo-interno{
    background-color: red;
}



.a{
    border: 5px solid pink ;
}
.b{
    border: 5px solid rgb(224, 3, 40) ;
}
.c{
    border: 5px solid rgb(132, 187, 6) ;
}
.d{
    border: 5px solid rgb(218, 6, 6) ;
}
.boton-C{

    margin-left: 2px;
    
}
.boton-E{

    margin-right: 0px;

}
.boton-F{

    margin-right: 0px;

    
}
.anchor{
    border: 5px solid red;
    width: 170px;
}
/*aqui empiza los hovers*/


.boton_hover:hover{
    background-color: rgb(43, 51, 172);
    transition-property: background-color;
    transition-duration: 0.5s ;
    border-radius: 5px;
    color: rgb(251, 252, 252) !important;
}


.engranaje{

    color: rgb(85, 55, 190);

}
.hover-drop{

    color: black;
}
.hover-drop:hover{
    background-color: rgb(121, 121, 214);
    position: static;
    display: block;

}

/*bordes*/
.border-b{
    border: 5px solid blue;
}
.border-r{
    border: 5px solid red;
}
.border-y{
    border: 5px solid yellow;

}
.border-g{
    border: 5px solid green;
}
.border-o{
    border: 5px solid orange;
}
.border-black{
    border: 5px solid rgb(0, 0, 0);
}
.color-konosuba{
    color: rgb(52, 143, 213);
}
.color-texto{
    color: white;
}
.fondo-konosuba{
    background-color: rgba(52, 143, 213, 0.795);
    color: white;
    border: none;
}
.fondo-konosuba:hover{
    background-color: #5175a1;
    color: white;
   
}
.sin-fondo-bordes{
    background-color: rgba(30, 158, 180, 0);
    border: 0px solid rgba(177, 177, 14, 0);
}

/*criticas*/
.cabezera-criticas{
    border-bottom: 1px solid white;

}
.font-critica{
    font-size: 14px;
}
.font-titulo-mayor{
    font-size: 30px;
}
.font-titulo-menor{
    font-size: 18px;
}




.final{
    border:10px solid rgb(0, 0, 0);
    border-radius: 15px;
    background-color: rgb(0, 106, 106);


}

.calificacion-1{
    color: rgb(246, 239, 239);
    font-size: 20px;
    text-align: center;

}
.nota-1{
    color: rgba(255, 255, 255, 0.815);
    font-size: 3rem;
    text-align: center;

}
/*calificaicon para contadores*/
.butt-inicio{

    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    border: 5px solid rgb(52, 143, 213);
    background-color: rgb(52, 143, 213);
    width: 190px;
    height: 70px;
    color: #fbfbfb;
    font-family: 'Courier New';
    font-weight: 600;
    font-size: 30px;

    transition-property: background-color ease;
    transition-property: border-color ease;
    transition-duration: 500ms;
}
.butt{


    background-color: rgb(52, 143, 213);
    border: 5px solid rgb(52, 143, 213);

    color: #ffffff;
    font-family: 'Courier New';
    font-weight: 700;
    font-size: 30px;
    transition-property: background-color ease;
    transition-property: border-color ease;
    transition-duration: 500ms;


}
.butt-final{
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    background-color: rgb(52, 143, 213);
    border: 5px solid rgb(52, 143, 213);
    width: 185px;
    height: 70px;
    color: #ffffff;
    font-family: 'Courier New';
    font-weight: 900;
    font-size: 30px;
    margin-left: -5px;
  
    
}
@media (max-width: 412px){
    .butt-sub-start{

        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;

    }
    .butt-sub-end{

        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

}

.butt-inicio:hover{
    background-color: rgb(103, 254, 171);
    border-color: rgb(103, 254, 171);
}
.butt:hover{
    background-color: rgb(103, 254, 171);
    border-color: rgb(103, 254, 171);
}
.butt-final:hover{
    background-color: rgb(103, 254, 171);
    border-color: rgb(103, 254, 171);
}

/*contadores*/

.Contador-inicio{
    display: block;
    color: #ffffff;
    font-weight: 900;
    width: 170px;
    height: 30px;
    text-decoration: none;
    font-size: 15px;
    
    text-align: center;


}
.Contador{
    display: block;
    color: #ffffff;
    font-weight: 900;
    width: 170px;
    height: 30px;
    text-decoration: none;
    font-size: 15px;
    text-align: center;
 

}
.Contador-final{
    display: block;
    color: #ffffff;
    font-weight: 900;
    width: 170px;
    height: 30px;
    text-decoration: none;
    text-align: center;
    font-size: 15px;
  

}


/*tooltip*/


.icono {
    position:relative;
    color: red;

}
.tooltip-24{
    color: rgb(52, 143, 213);

    border: 5px solid rgb(0, 4, 7);
    background: rgb(20, 3, 3);  

    display: flex;
    width: 13em;
    z-index: 5000;
    border-radius: 7px;

    box-shadow: 5px 5px 40px rgba(0, 0, 0, 0.6);
    position: absolute;
    top: 0px;
    left: 0;

    opacity: 1;
    transition: 0.3s ease opacity;
    transform: translateY(10px);
    align-items: center;


}
.tooltip-24::after{
    content: " ";
    display: inline-block;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    border-top: 15px solid rgb(20, 3, 3); 
    position: absolute;
    bottom: -15px;
    left: calc(50% - 25px);


}


.activo{
    opacity: 1;
    /*background-color: #052f3abb; esto es el color de comentarios*/
}



.fantasma{
    opacity: 0;
    z-index: -1;
}




.forma{
    border: 0px solid pink;
    background-color: none;
    border-radius: 50px;

}
.contenido-icono svg{
    width: 25px;
    height: 25px;

    color: rgb(220, 227, 233);
    background-color: rgb(3, 43, 75);
    border-radius: 50px;
    transition-property: width ease;
    transition-property: height ease;
    transition-duration: 1s;
    
    /*color: rgb(52, 143, 213);*/

}

/*animacion expansion*/

.base_exp{
    width:213.5px; 
    height:305.44px;
}
.exp_7{

    position: absolute;
}

.exp_8{
    position: absolute;

}
.base_exp:hover .exp_7 .contenido-icono >  svg{
    position: relative;
    width: 35px;
    height: 35px;
    z-index: 110;

}
.exp_9{
    transition-property: width ease;
    transition-property: height ease;
    transition-duration: 1s;
}

.base_exp:hover .exp_7 a  > .exp_9{
    width: 255.5px; 
    height: 350.44px;
    box-shadow: 7px 13px 37px #000;
    position: relative;
    z-index: 100;

}
*{margin: 0; padding: 0

}


body{
    background-color: #10171f;
    position: relative;
    padding-bottom: 0px;
    min-height: 100%;
    display: flex;
    flex-direction: column;

}
html{
    height: 100%;
}

.back{
    background-color: #10171f
}



/*base para los headerss 
.header{
    display: block;
    font-family: Arial;
    background-color: #151f2b ;
    color: white;
    position: sticky;
    left: 0;
    top: 0;
    right: 0;
    z-index: 300;
    border-bottom: 1px solid white;

    

    
}
*/
/*base para los headers no tiene afecto*/

.header a{
    color: rgb(229, 218, 218);
    text-decoration: none;

}
.container{
    width: 85%;

    width: 1000px;
    margin: 0 auto;
    position: relative;
    display: block;

    
}



.logo-nav{
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    flex-wrap: wrap;
    height: 100px;



}
.menu-icon{
    display:none;
}

.navigation ul{
    margin: 0;
    padding: 0;
    list-style: none;

}

.navigation ul li {
    display: inline-block
    
}

/*aca inicia el header off*/
.nav-off{

    width: 300px;
    height: 100px;
    position: absolute;
    top: 45px;
    left: 790px;
    font-size: 18px;
    


}
.acceder{
    display: inline-block;
    background-color: rgb(55, 24, 141);
    margin-right: 20px;
    padding: 10px;
    border-radius: 5px;
    

}

.registro{
    display: inline;
    background-color: rgb(55, 24, 141);
    border: 15px;
    margin-right: 20px;
    padding: 10px;
    border-radius: 3px;
}

/*aca cierra el header off*/
/*aca inicia el header on*/

.nav-ON{
    list-style: none;
    display: inline-flex;
    position: relative;
    left: 400px;
    bottom: 45px;

}
.ON{
    display: none;
    background-color: rgb(0, 129, 189);
    width: 180px;
    position: absolute;
    left: 70px;
    border-radius: 5px;
    list-style:none;
    
}


.botones{
    display:block;
}
.nombre-ON{
    width: 200px;
    height: 40px;
    border-radius: 30px;
    margin-left: 10px;
}
.button-ON{
    display: inline-block;
    margin-left: 10px;
    width: 40px;
    height: 40px;
    border-radius: 50px;
}
.AD-cuenta{

    position: relative;
    display: block;
    left: 0px;
    width: 185px;
    text-align: center;

}

.botones:hover > .ON {
    display: block;

}
.AD-cuenta:hover{
    background-color: rgb(106, 214, 73);
    border-radius: 5px;
}
/*aca cierra el header on*/
.color-v{
    color:rgb(229, 253, 8);
}









/*el hpta buscador*/
body, div, fieldset{
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
}
.cajabuscar {
    float: none;
    width: 120%;
    height: 40%;
    position: relative;
    right: 188px;
    top: 14px;
    max-width: 453px;
    margin-bottom: 25px;
    margin-top: 29px;
    margin-left: auto;
    margin-right: auto;
    display: inline-block;
    text-align: left;
}

#buscarform {
    padding: 0;
    clear: both;
    width: 100%;
    position: relative;
    display: inline-block;
}
#buscarform fieldset { float: left }

#buscarform .search {
    font-size: 20px;
    top: 0px;
    color: #FFF;
    position: absolute;
    right: 0;
    top: 0;
    padding: 9px;
    height: 24px;
    width: 24px;
    text-align: center;
}
#buscarform fieldset { width: 100% }

#s {
    width: 100%;
    background-color: #fff;
    float: left;
    padding: 8px 0;
    text-indent: 10px;
    color: #555555;
    border: 1px solid #fff; 
    box-sizing: border-box;
    height: 42px;
}

.button{
    right: 0;
    top: 0;
    padding: 9px 0;
    float: right;
    border: 0;
    width: 42px;
    height: 42px;
    cursor: pointer;
    text-align: center;
    padding-top: 10px;
    color: #a4a4a4;
    transition: all 0.25s linear;
    background: transparent;
    z-index: 10;
    position: absolute;
    border: 0;
    vertical-align: top;
    background-color: #1345c4;
}


/*base par las portadas de imagenes */



.portadas{


    border: 10px solid #151f2b ;
    display: block;
    border-radius: 5px;
    position: relative;
    left: 5px;
    right: 0px;

    width: 1050px;
    margin-top: 40px;
    margin-bottom: 40px;
    margin-right: auto;
    margin-left: auto;

    text-align: center;
    background-color: #151f2b ;


}

/*testo de marque transisivo*/

.base{
    display: inline-block;
    align-items: center;
    position: relative;
    width: 213.5px;
    height: 305.44px;
    margin-right: 10px;
    margin-bottom: 10px;
    margin-top: 10px;
}

.img{
    width: 100%;
    height: 100%;
    border-radius: 7px;
    
}

.cuadro{
    background-color: rgb(255, 0, 0);
    border-radius: 7px;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    opacity: 0.8;
    overflow: hidden;
    position: absolute;
    top: 243px;
    width: 100%;
    height: 20%;
    transition-property: opacity ease;
    transition-duration: 1s;
    opacity: 0;

}
.texto{
    position: absolute;
    left: 3px;
    height: 80%;
    font-size: 20px;
    white-space: nowrap;
    text-decoration: none;
    color: rgb(0, 0, 0);
    transition-property: background-color ease;
    transition-property: opacity ease;
    transition-duration: 1s;
    visibility: hidden;
    opacity: 0;

}

/*hoover con marque*/

.portadas .base:hover .cuadro > .texto{
    animation: code-anima 10s 2s linear infinite;
    visibility: visible;
    opacity: 1;
}
.portadas .base:hover>.cuadro{

    opacity: 0.8;
} 

/*animation*/

@keyframes code-anima{
    100%{
            transform: translate(-120%,0);
    }
}



.social-bar{
    position: fixed;
    left: 0;
    top:35%;
    font-size: 2rem;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    z-index: 100;
}
.icon{
    color: white;
    text-decoration: none;
    padding: .7rem;
    display: flex;
    transition: all .5s;
}
.icon-facebook{
    background: #2E406E;
}
.icon-twitter{
    background: #339DC5;
}
.icon-instagram{
    background: #b1423c;
}
.icon:first-child{
    border-radius: 0 1rem 0 0;
}
.icon:last-child{
    border-radius: 0 0 1rem 0;
}
.icon:hover{
    padding-left: 3rem;
    border-radius: 0 1rem 1rem 0;

}


.footer{

    margin-top: auto;
    display: block;
    font-family: 'Courier New';
    font-size: 10px;
    background: #151f2b;
    text-align: center;
    width: 100%;
    height: 125px;
    max-height: 125px;

}



.footer a{
    color: rgb(255, 255, 255);
    text-decoration: none;
}
.navegacion-del-footer ul li {
    margin-top: 10px;
    font-family: 'Courier New';
    display: inline-block;
    position: relative;
    top: 7px;
    left: 27%;
    margin-left: 10px;
    margin-bottom: 10px;

}
.navegacion-del-footer ul li a{
    position: relative;
    top: 20px;
    left: -20px;
    font-size: 15px;
    padding: 10px;
    border-radius: 5px;

}
.navegacion-del-footer ul li a:hover{
    background-color: red;
}





















/*ventana emergente para las donaciones */

.ventana-de-apoyo{

    width: 60px;
    height: 40px;
    position: relative;
    left: 93%;
    top: 15px;
    font-size: 15px;
    

}
.boton-modal label{
    width: 50px;
    height: 35px;
    border-radius: 5px;

}
.boton-modal label{
    padding: 10px 15px;
    color: rgb(255, 255, 255);
    cursor: pointer;
    transition: 300ms ease;
}
.boton-modal label:hover{
    background-color: red;
}
#btn-modal{
    display: none;
}


.contenedor-modal{
    background-color: rgba(98, 98, 218, 0.8);
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0px;
    left: 0px;
    justify-content: center;
    align-items: center;
    z-index: 140;
    display: none;
}
#btn-modal:checked~.contenedor-modal{
    display: flex;

}


.caja-modal{
    width: 100%;
    max-width: 400px;
    padding: 20px;
    background-color: white;
}
.texto-modal{
    margin-bottom: 20px;

}
.caja-modal p{
    margin-top: 10px;
}


.cerrar-modal{
    color: red;
    display: flex;
    justify-content: flex-end;

}
.caja-modal .cerrar-modal{
    width: 100%;
    display: flex;
    justify-content: flex-end;
}
.caja-modal .cerrar-modal label{
    padding: 7px 10px;
    background-color: rgb(17, 250, 17);
    color: blue;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 300ms ease;
}
.caja-modal .cerrar-modal label:hover{
    background-color: yellow;
}
.cerrar-fondo{
    width: 100%;
    height: 100vh;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}
.img-paypal{

    width: 40px;
    height: 40px;
}

/*aqui va el contenido del login*/
.formador{
    color: white;
    width: 400px;
    height: 380px;
    border-radius: 5px;
    background: #151f2b;
    box-shadow: 7px 13px 37px #000;

}

.cambio-login{

    border: 1px solid #1f53c3;
    border-radius: 4px;

    background: #24303c;
    font-size: 14px;
    font-weight: bold;

}
/*aqui va el contenido del register*/
.formador-registro{
    color:rgb(253, 253, 253);
    width: 400px;
    background: #151f2b;
    box-shadow: 7px 13px 37px #000;
    border-radius: 5px;
}
.re-control{
    background: #24303c;
    border: 1px solid #1f53c3;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 16px;
}





/*empenzanco comentarios*/
.nombre{
    text-decoration: none;
    cursor: default !important;
}


.limite{
    resize: none;
}

.redondo-a{
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}
.redondo-b{
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}

.boton-cosas{

    background-color: lightblue;
    width: 90px;
    height: 50px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;

}

























@media (max-width: 320px){
    body{
        background-color: #b1423c;
    }
    .portadas{
        display: block;
        position: relative;
        width: 260px;
        height: 500px;
        margin-left: 200px;
        margin-top: 75px;
        margin-bottom: 40px;
        margin: 50px auto;
        left: 5px;
        right: 0px;
        text-align: center;
        background-color: #fefefe ;
    }
    .menu-icon{
        display: block;
        cursor: pointer;
        padding: 0.5rem 1rem;
    }
    .navigation{
        width: 100%;

    }

    .navigation ul{
        display: block;
    }
    .navigation ul.show{
        display: block;
    }

    .navigation ul li {


        width: 200px;
        display: block;
        margin-top: 1rem;
    }
    .navigation ul li a{
        font-size: 10px;
        display: block;
        padding: 0.5rem 0;
        transition: all 0.4 linear;
        border-radius: 5px;
    }
    .navigation ul li a:hover{
        background: #4a4a4a;
    }
    .social-bar{
        position: fixed;
        left: 0;
        top:35%;
        font-size: 1rem;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        z-index: 100;
    }
    .icon{
        color: white;
        text-decoration: none;
        padding: .7rem;
        display: flex;
        transition: all .5s;
    }
    .img1, .img2,.img3,.img4{
        align-items: center;
        width: 111.5px;
        height: 206.44px;
        margin-right: 10px;
        margin-bottom: 10px;
        margin-top: 10px;
    
    }
    .navegacion-del-footer ul li {
        display: inline-block;
    }
    .navegacion-del-footer ul li a{
        display: inline-block;
        
        padding: 2rem 3rem;
        transition: all 0.4 linear;
        border-radius: 5px;
    

    }
}
@media (max-width: 412px){
    body{
        background: #151f2b;
    }
    .portadas{
        display: block;
        position: relative;
        width: 320px;
        height: 500px;
        margin-left: 200px;
        margin-top: 75px;
        margin-bottom: 40px;
        margin: 50px auto;
        left: 5px;
        right: 0px;
        text-align: center;
        background-color: #fefefe ;
    }
    .menu-icon{
        display: block;
        cursor: pointer;
        padding: 0.5rem 1rem;
    }

    .navigation{
        width: 100%;
    }
    .navigation ul{
        display: none;
    }
    .navigation ul.show{
        display: block;
    }
    .navigation ul li {
        display: block;
        margin-top: 1rem;
    }
    .navigation ul li a{
        font-size: xx-small;
        display: block;
        padding: 0.5rem 0;
        transition: all 0.4 linear;
        border-radius: 5px;
    }
    .navigation ul li a:hover{
        background: #4a4a4a;
    }



    .social-bar{
        position: fixed;
        left: 0;
        top:35%;
        font-size: 1rem;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        z-index: 100;
    }
    .icon{
        color: white;
        text-decoration: none;
        padding: .7rem;
        display: flex;
        transition: all .5s;
    }
    .img1, .img2,.img3,.img4{
        align-items: center;
        width: 131.5px;
        height: 206.44px;
        margin-right: 10px;
        margin-bottom: 10px;
        margin-top: 10px;
    
    }
    .navegacion-del-footer ul li {
        display: inline-block;
    }
    .navegacion-del-footer ul li a{
        display: inline-block;
        
        padding: 2rem 3rem;
        transition: all 0.4 linear;
        border-radius: 5px;
    }

    .menu-icon{
        display: block;
        cursor: pointer;
        padding: 0.5rem 1rem;
        position: relative;
        left: -10px;
        
    }
    .prueba-3{
        width: 180.5px;
        height: 216.44px;

    }
    
}

</style>