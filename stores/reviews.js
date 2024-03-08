export const ReviewAd = defineStore('ReviewAd',{
    state:()=>(
        {
            review:[],
            review_edit:[],
        }
    ),
    getters:{

    },
    actions:{
        async Review_post(formdata){
            // console.log(formdata);
            try {
                const response = await $fetch('http://127.0.0.1:8000/api/review',{
                    method: 'POST',
                    body: formdata,
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                // console.log(response);
            } catch (error) {
                console.log(error.response)
            }
        },
        async Review_get(){
            try {
                const response = await $fetch('http://127.0.0.1:8000/api/review',{
                    method: 'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                console.log(response);
                this.review = response.reviews;
            } catch (error) {
                console.log(error.response);
            }
        },
        async Review_get_paginate(page){
            try {
                const response = await $fetch(`http://127.0.0.1:8000/api/review?page=${page}`,{
                    method: 'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                console.log(response);
                this.review = response.reviews;
            } catch (error) {
                console.log(error.response);
            }
        },
        async Review_put(formdata,id){
            console.log(id);
            console.log(formdata);
            try {
                const response = await $fetch(`http://127.0.0.1:8000/api/review/${id}`,{
                    method: 'PUT',
                    body: formdata,
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                console.log(response);
            } catch (error) {
                
            }
        },
        async Review_delete(formdata){
            try {
                const response = await $fetch(`http://127.0.0.1:8000/api/review/${formdata}`,{
                    method: 'DELETE',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                console.log(response);
                
            } catch (error) {
                
            }
        },
        async Review_get_edit(formdata){
            console.log(formdata);
            try {
                const response = await $fetch(`http://127.0.0.1:8000/api/review/${formdata}/edit`,{
                    method: 'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                console.log(response);
                this.review_edit = response;
            } catch (error) {
                console.log(error.response);
            }
        }

    },
})