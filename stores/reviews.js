export const ReviewAd = defineStore('ReviewAd',{
    state:()=>(
        {
            review:[],
            review_edit:[],
            review_search:null,
            content_type:[],
            authors:[],
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
                // console.log(response);
                this.review = response.reviews;
                this.review_search=null
            } catch (error) {
                console.log(error.response);
            }
        },
        async Review_get_paginate(page,search){
            if(search){
                try {
                    if (this.review_search == null  || search !== this.review_search) {
                        this.review_search=search
                    }
                    const response = await $fetch(`http://127.0.0.1:8000/api/review?page=${page}&search=${search}`,{
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
                    console.log(error.response._data.errors);
                }
            }else{
                if(this.review_search == null){
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
                        console.log(error);
                    }
                }else{
                    try {
                        search =this.review_search
                        console.log(search)
                        console.log(page)
                        const response = await $fetch(`http://127.0.0.1:8000/api/review?page=${page}&search=${search}`,{
                            method: 'GET',
                            headers:{
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type':'application/json',
                            },
                            credentials:'include'
                        })
                        // console.log(response);
                        this.review = response.reviews;
                    } catch (error) {
                        console.log(error);
                    }
                }
            }
        },
        async Review_get_edit(formdata){
            // console.log(formdata);
            try {
                const response = await $fetch(`http://127.0.0.1:8000/api/review/${formdata}/edit`,{
                    method: 'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                // console.log(response);
                this.review_edit = response;
            } catch (error) {
                console.log(error.response);
            }
        },
        async Review_content_type(){
            try {
                const response = await $fetch(`http://127.0.0.1:8000/api/content_type`,{
                    method: 'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                // console.log(response.content_type);
                this.content_type = response.content_type;
            } catch (error) {
                console.log(error);
            }
        },
        async filter(){
            try {
                const data  = await $fetch(`http://127.0.0.1:8000/api/pluck/authors`, {
                    method: 'GET',
                })
                this.authors = data.authors;
            } catch (error) {
                throw error
            }
        },
        async Review_put(formdata,id){
            try {
                const data = await $fetch(`http://127.0.0.1:8000/api/review/${id}`,{
                    method: 'PUT',
                    body: formdata,
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
            } catch (error) {
                console.log(error);
            }
        }

    },
})