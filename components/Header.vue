<script setup>
const loginP = LoginStore();

</script>
<template>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <NuxtLink to="/">
        <img src="/placeholder.png"  width="180" height="50">
    </NuxtLink>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end mt-2" id="navbarSupportedContent">
        <div>
            <div class="d-flex justify-content-end"  >
                   <ul class="navbar-nav d-inline-block">
                      <Login />
                  </ul>
                  <ul v-if="!loginP.session" class="navbar-nav d-inline-block ms-3">
                       <NuxtLink to="/Register">
                        <Button_g class="btn-primary" type="submit">Registro</Button_g>
                      </NuxtLink>
                  </ul>
            </div>
        </div>
    </div>
  </div>
</nav>



</template>