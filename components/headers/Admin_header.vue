<script setup>

</script>

<template>
    <HeaderBase component-name="HeaderAdmin">
        <div>
            <div class="d-flex justify-content-end">
                <ul class="navbar-nav d-inline-block">
                    <NuxtLink>
                        <ButtonG class="btn-outline-dark log me-2">
                            <i class="bi bi-window"><a class="base_ad ms-2">Panel de control</a></i>
                        </ButtonG>
                    </NuxtLink>
                </ul>
                <ul class="navbar-nav d-inline-block">
                    <Login IconName="IconAdmin" />
                </ul>
            </div>
        </div>
    </HeaderBase>
</template>

<style scoped>
.base_ad{
    text-decoration: none;
    color: black;
}

</style>