// public/js/validations.js

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const codigoInput = document.getElementById("codigo");
  const nombreInput = document.getElementById("nombre");
  const precioInput = document.getElementById("precio");
  const materialesInputs = document.querySelectorAll(
    "input[name='material[]']"
  );
  const bodegaSelect = document.getElementById("bodega");
  const monedaSelect = document.getElementById("moneda");
  const sucursalSelect = document.getElementById("sucursal");
  const descripcionInput = document.getElementById("descripcion");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); 
    validateCodigo().then((isValidCodigo) => {
      const isValidNombre = validateNombre();
      const isValidBodega = validateBodega();
      const isValidSucursal = validateSucursal();
      const isValidMoneda = validateMoneda();
      const isValidPrecio = validatePrecio();
      const isValidMateriales = validateMateriales();
      const isValidDescripcion = validateDescripcion();
      if (
        isValidCodigo &&
        isValidNombre &&
        isValidPrecio &&
        isValidMateriales &&
        isValidBodega &&
        isValidMoneda &&
        isValidSucursal &&
        isValidDescripcion
      ) {
        form.submit(); 
      }
    });
  });

  async function validateCodigo() {
    const codigo = codigoInput.value.trim();
    const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/;

    if (codigo.length < 5 || codigo.length > 15) {
      alert("El código del producto debe tener entre 5 y 15 caracteres.");
      return false;
    }

    if (!regex.test(codigo)) {
      alert("El código del producto debe contener letras y números.");
      return false;
    }

    const response = await fetch(
      `index.php?action=checkCodigo&codigo=${codigo}`
    );
    const data = await response.json();

    if (data.exists) {
      alert("El código del producto ya está registrado.");
      return false;
    }

    return true;
  }

  function validateNombre() {
    const nombre = nombreInput.value.trim();

    if (nombre === "") {
      alert("El nombre del producto no puede estar en blanco.");
      return false;
    }

    if (nombre.length < 2 || nombre.length > 50) {
      alert("El nombre del producto debe tener entre 2 y 50 caracteres.");
      return false;
    }

    return true;
  }

  function validatePrecio() {
    const precio = precioInput.value.trim();
    const regex = /^\d+(\.\d{1,2})?$/;

    if (precio === "") {
      alert("El precio del producto no puede estar en blanco.");
      return false;
    }

    if (!regex.test(precio) || parseFloat(precio) <= 0) {
      alert(
        "El precio del producto debe ser un número positivo con hasta dos decimales."
      );
      return false;
    }

    return true;
  }

  function validateMateriales() {
    let selectedMaterials = 0;
    materialesInputs.forEach((input) => {
      if (input.checked) {
        selectedMaterials++;
      }
    });

    if (selectedMaterials < 2) {
      alert("Debe seleccionar al menos dos materiales para el producto.");
      return false;
    }

    return true;
  }

  function validateBodega() {
    const bodega = bodegaSelect.value.trim();

    if (bodega === "") {
      alert("Debe seleccionar una bodega.");
      return false;
    }

    return true;
  }

  function validateMoneda() {
    const moneda = monedaSelect.value.trim();

    if (moneda === "") {
      alert("Debe seleccionar una moneda para el producto.");
      return false;
    }

    return true;
  }

  function validateSucursal() {
    const sucursal = sucursalSelect.value.trim();

    if (sucursal === "") {
      alert("Debe seleccionar una sucursal para la bodega seleccionada.");
      return false;
    }

    return true;
  }

  function validateDescripcion() {
    const descripcion = descripcionInput.value.trim();

    if (descripcion === "") {
      alert("La descripción del producto no puede estar en blanco.");
      return false;
    }

    if (descripcion.length < 10 || descripcion.length > 1000) {
      alert(
        "La descripción del producto debe tener entre 10 y 1000 caracteres."
      );
      return false;
    }

    return true;
  }
});
