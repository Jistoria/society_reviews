<script setup>
const { showErrorAlert, showLoadingAnimation, showSuccessAlertSkinny, showConfirmationAlert,showErrorNormalAlert} = AlertaSesion();

const rawrf="review"
const n = 10;
const reviewP = ReviewAd();
onMounted(async () => {
    await reviewP.Review_get();
});
const delete_review =  async(data , title)=>{

    const conf = await showConfirmationAlert('¿Quieres eliminar la reseña?', ' ' + title);
    if(conf== true){
        try {
            showLoadingAnimation('Procesando');
            const review = await reviewP.Review_delete(data);
            console.log(review);
            if (review.success === true) {
                showSuccessAlertSkinny(review.message);
                await reviewP.Review_get_paginate(reviewP.review.current_page);
            } else {
                await showErrorNormalAlert('Error en la eliminacion', review.message);
            } 
        } catch (error) {
            console.log(error);
            await showErrorNormalAlert('Error', [error.message]); // Capturas el mensaje de error y lo muestras en la alerta
        }
    }else{
        return
    }
    // await reviewP.Review_get_paginate(reviewP.review.current_page);
}
const handlePageChange = async (page,search) => {
  await reviewP.Review_get_paginate(page,search)
};
const published = async(id, titulo, check)=>{

    if(check == false){
        const cof = await showConfirmationAlert('vas a Publicar '+ titulo);
        if(cof == true){
            const review  =  await reviewP.published(id);
            console.log(review.success)
            if(review.success == true){
                showSuccessAlertSkinny('Reseña publicada con Exito')
                await reviewP.Review_get_paginate(reviewP.review.current_page)

            }
        }
    }else{
        const cof = await showConfirmationAlert('Esta reseña '+ titulo + ' dejara de ser publica');
        if(cof == true){
            const review =  await reviewP.published(id);
            if(review.success == true){
                showSuccessAlertSkinny('Reseña dejo de ser publica')
                await reviewP.Review_get_paginate(reviewP.review.current_page)

            }
        }
    }

}
</script>
<template>
 <!-- {{ reviewP.review.data }} -->
    <div>
        <div >
            <Buscador
                :rawr="rawrf"
                :onSearch="handlePageChange"
            />
        </div>
        <div>
            <div class="btn btn-dark ms-4 ">
                <NuxtLink to="/place/admin/reviews/reviewPOST"  style="color:white; text-decoration: none;">
                    crear reseña
                </NuxtLink>
            </div>
        </div>
        <div class="base_review_ad ">
            <div class="row ">
                    <div class="col-12 ">
                        <div class="container-fluid ">
                            <div class="data_contain_flex ">
                                <div class="item_review_ad d-inline-block   mt-2 me-3" v-for="reviews in reviewP.review.data">
                                    <div class="d-flex">
                                        <div class="img_conf ">
                                            <img :src="`${reviews.franchise.image_url}`" >
                                        </div>
                                        <div class="flex-grow-1 ">
                                            <div class="d-flex justify-content-center mb-2 mt-2">
                                                <NuxtLink :to="{ path:'/place/admin/reviews/reviewPUT', query: { id_review: reviews.review_id }}">
                                                    <ButtonG class="btn-dark">
                                                            <i class="bi bi-indent" style="font-size: 1.3rem;" ></i>
                                                    </ButtonG>
                                                </NuxtLink>
                                            </div>
                                            <div class="d-flex justify-content-center  mb-2 ">
                                                <ButtonG :class="reviews.published ? 'btn-success' : 'btn-danger'" @click="published(reviews.review_id , reviews.title_alternative,reviews.published)">
                                                    <i v-if="reviews.published == false" class="bi bi-calendar-x" style="font-size: 1.3rem; color: white;"></i>
                                                    <i v-else class="bi bi-calendar-check"   style="font-size: 1.3rem; color: white;"></i>
                                                </ButtonG>
                                            </div>
                                            <div class="d-flex justify-content-center  mb-2 ">
                                                <ButtonG class="btn-warning" @click="delete_review(reviews.review_id, reviews.title_alternative)">
                                                    <i class="bi bi-x" style="font-size: 1.3rem;"></i>
                                                </ButtonG>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="ms-2">
                                            <!-- ponerle limite de cuantas letras deben estar para hacer uno que cuando haga hoover transpase o solo poner los .... -->
                                            <div class="p-2">
                                                <p>{{ reviews.title_alternative }}</p>
                                            </div>
                                            <h5 class="ms-2">{{ reviews.rating_main }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <Paginacion
                :currentPage="reviewP.review.current_page"
                :totalPages="reviewP.review.last_page"
                :onPageChange="handlePageChange"
                :items="reviewP.review.data"
            />
        </div>
    </div>


</template>
<style>

.item_review_ad{
    border: 0px solid red;
    width: 300px !important;
    height: 320px; 
    border-radius: 15px;
    background: rgb(181, 202, 193);
}
.base_review_ad{
    /* height: 500px; */
    width: 1500px;
    /* width: 100%; */
}
.img_conf{
    width: 160px; 
    height: 180px;
    display: inline-block;
    border: 0px solid green;
    padding: 0 !important;
    margin: 0 !important;

}
.img_conf img{
    border: 0px solid red;
    margin-left: 4px;
    border-radius: 15px;
    width: 160px; 
    height: 180px;
}

</style>