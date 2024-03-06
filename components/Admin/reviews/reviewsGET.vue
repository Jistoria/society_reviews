<script setup>
const n = 10;
const reviewP = ReviewAd();
onMounted(async () => {
    console.log('me monte')
    await reviewP.Review_get();
});
const delete_review =  async(data)=>{
    console.log(data);
    await reviewP.Review_delete(data);
    await reviewP.Review_get();
}
</script>
<template>
    <div class="border_r">
        <NuxtLink :to="{ path:'/place/admin/reviews/reviewPUT', query: { id_review: 3 }}">
                                        <ButtonG class="btn-secondary" >
                                            <i class="bi bi-clipboard"> review 1</i>
                                        </ButtonG>
        </NuxtLink>
    </div>
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
                    <div class="col-12  base_t" v-for="reviews in reviewP.review">
                        <div class="container-fluid border_black">
                            <div class="row border_y">
                                <div class="col-3  base_image">
                                    <img src="../../../assets/images.jfif" >
                                </div> 
                                <div class="col-9 border_v base_content">
                                    <div class="card">
                                        <div class="card-header">
                                            Better Call Saul
                                        </div>
                                        <div class="card-body">
                                            <NuxtLink :to="{ path:'/place/admin/reviews/reviewPUT', query: { id_review: reviews.review_id }}">
                                                <ButtonG class="border_y">{{ reviews.review_id }} actualizar</ButtonG>
                                            </NuxtLink>
                                            <ButtonG @click="delete_review(reviews.review_id)">Eliminar</ButtonG>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</template>
<style>

</style>