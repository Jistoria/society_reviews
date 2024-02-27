<script setup>
const n = 10;

</script>
<template>
    <div class="container-fluid border_black" >
            <div class="border_y container">
                <!-- hacer un composable para franquisias y tags con el mismo para reseñas -->
                <div class="row">  
                    <div class="col-3">
                        <NuxtLink to="/place/admin/reviews/reviewPOST">
                            crear review
                        </NuxtLink>
                    </div> 

                </div>
                <div class="row base_r">
                    <div class="col-12  base_t"
                    v-for="index in n" :key="index">
                        <Card>
                        </Card>
                    </div>
                </div>
            </div>
        </div>
</template>
<style>

</style>