$(function(){
    $('.indicio-activo').tooltip(
       {
          delay: 50,
          tooltip: 'Estoy pendiente.',
          position: 'bottom'
       }
    );
    $('.indicio-prestamo').tooltip(
       {
          delay: 50,
          tooltip: 'Estoy en prestamo.',
          position: 'bottom'
       }
    );
    $('.indicio-baja').tooltip(
       {
          delay: 50,
          tooltip: 'Estoy rechazada.',
          position: 'bottom'
       }
    );
    $('.indicio-bloqueada').tooltip(
       {
          delay: 50,
          tooltip: 'Estoy bloqueada.',
          position: 'bottom'
       }
    );
    $('.cadena-estado-editar').tooltip(
       {
          delay: 50,
          tooltip: 'Estoy habilidata para edición.',
          position: 'bottom'
       }
    );
    //cadena baja
    $('.cadena-estado-baja').tooltip(
       {
          delay: 50,
          tooltip: 'Estoy dado de baja',
          position: 'bottom'
       }
    );
    //cadena prestamo
    $('.cadena-estado-prestamo').tooltip(
       {
          delay: 50,
          tooltip: 'Estoy en prestamo',
          position: 'bottom'
       }
    );
    //cadena prestamo parcial
    $('.cadena-estado-prestamo-parcial').tooltip(
       {
          delay: 50,
          tooltip: 'Tengo un prestamo parcial',
          position: 'bottom'
       }
    );
    //cadena observación
    $('.cadena-estado-observacion').tooltip(
       {
          delay: 50,
          tooltip: "<span>Tengo una nota u observación</span> <i class='fas fa-smile'></i>",
          position: 'bottom',
          html: true
       }
    );
 });