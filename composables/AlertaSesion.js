import Swal from 'sweetalert2';
import { ref } from 'vue';

export function AlertaSesion() {
  // Función para controlar la instancia de SweetAlert
  const swalInstance = ref(null);
  const { $swal } = useNuxtApp();
  // Función para mostrar una alerta de éxito
  const showSuccessAlert = async (title, text) => {
    await showInstanceAlert(title, text, 'success');
  };
//Funcion para los errores, pueden ser varios o uno solo
  const showErrorAlert = async (title, errors) => {
    await Swal.fire({
        title: title,
        icon: 'error',
        html: errors.map(error => `<div>${error}</div>`).join('')
    });
};

  // Función para mostrar una alerta de información
  const showInfoAlert = async (title, text) => {
    await showInstanceAlert(title, text, 'info');
  };
//Funcion para mensajes de success en la parte superior derecha de LOGIN SOLAMENTE
  const showSuccessAlertSession = async (title, text) => {
    const Toast = $swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = $swal.stopTimer;
            toast.onmouseleave = $swal.resumeTimer;
        }
    });

    await Toast.fire({
        icon: "success",
        title: title + ' ' + text // Ajusta el título según tus necesidades
    });
};
//Funcion para mensajes de success en la parte superior derecha de LOGIN SOLAMENTE
const showSuccessAlertSkinny = async (title) => {
  const Toast = $swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
          toast.onmouseenter = $swal.stopTimer;
          toast.onmouseleave = $swal.resumeTimer;
      }
  });

  await Toast.fire({
      icon: "success",
      title: title
  });
};
  // Función para mostrar una alerta de confirmación
  const showConfirmationAlert = async (title, text) => {
    const result = await Swal.fire({
      title,
      text,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar',
    });
    return result.isConfirmed;
  };

  // Función para mostrar una animación de carga
  const showLoadingAnimation = async (title) => {
    swalInstance.value = await Swal.fire({
      title,
      html: '<div class="spinner-border text-primary mt-2 mb-2"></div>',
      showConfirmButton: false,
    });
  };
  // Función para cuando no se aceptaron terminos y condiciones
  const showErrorTerms = async (title) => {
    const terms = Swal.fire({
      title,
      icon: 'error',
    })
  };


  // Función para cerrar la animación de carga
//   const closeLoadingAnimation = async (title) => {
//     if (swalInstance.value) {
//       swalInstance.close();
//     }
//   };

  // Función interna para mostrar una alerta con SweetAlert2
  const showInstanceAlert = async (title, text, icon) => {
    await Swal.fire({
      title,
      text,
      icon,
    });
  };


  return {
    showSuccessAlertSession,
    showSuccessAlert,
    showErrorAlert,
    showInfoAlert,
    showConfirmationAlert,
    showLoadingAnimation,
    showErrorTerms,
    showSuccessAlertSkinny,
    // closeLoadingAnimation,
  };
}