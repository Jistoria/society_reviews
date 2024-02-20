<script setup>

</script>

<template>
    <HeaderBase component-name="HeaderSuperAdmin">
        <div>
            <div class="d-flex justify-content-end ">
                <ul class="navbar-nav d-inline-block me-2">
                    <NuxtLink>
                        <ButtonG class="btn-outline-dark log">
                            <i class="bi bi-archive-fill"><a class="base_SAdmin ms-2">Dashborad</a></i>
                        </ButtonG>
                    </NuxtLink>
                </ul>
                <ul class="navbar-nav d-inline-block">
                    <Login IconName="IconSuperAdmin" />
                </ul>
            </div>
        </div>
    </HeaderBase>
</template>

<style scoped>
.base_SAdmin{
    text-decoration: none;
    color: black;
}
</style>