export const FranchiseAd = defineStore('franchiseAd',{
    state:()=>(
        {
            franchise:[],
            franchise_search:null,
            franchise_edit:[],
            franchise_edit_tags:[],
        }
    ),
    getters:{

    },
    actions:{
        async Franchise_post(formdata){
            console.log(formdata);
            try {
                const response = await $fetch('http://127.0.0.1:8000/api/franchise',{
                    method: 'POST',
                    body: formdata,
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                console.log(response);
                return response;
            } catch (error) {
                console.log(error.response._data);
                return error.response._data

            }
        },
        async Franchise_get(){
            try {
                const response = await $fetch('http://127.0.0.1:8000/api/franchise',{
                    method: 'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                // console.log(response);
                this.franchise = response.franchises;
            } catch (error) {
                console.log(error);
            }
        },
        async Franchise_get_paginacion(page,search){
            if(search){
                try {
                    if (this.franchise_search == null  || search !== this.franchise_search) {
                        this.franchise_search=search
                    }
                    const response = await $fetch(`http://127.0.0.1:8000/api/franchise?page=${page}&search=${search}`,{
                        method: 'GET',
                        headers:{
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type':'application/json',
                        },
                        credentials:'include'
                    })
                    // console.log(response);
                    this.franchise = response.franchises;
                } catch (error) {
                    console.log(error);
                }
            }else{
                if(this.franchise_search == null){
                    try {
                        const response = await $fetch(`http://127.0.0.1:8000/api/franchise?page=${page}`,{
                            method: 'GET',
                            headers:{
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type':'application/json',
                            },
                            credentials:'include'
                        })
                        // console.log(response);
                        this.franchise = response.franchises;
                    } catch (error) {
                        console.log(error);
                    }
                }else{
                    try {
                        search =this.franchise_search
                        console.log(search)
                        console.log(page)
                        const response = await $fetch(`http://127.0.0.1:8000/api/franchise?page=${page}&search=${search}`,{
                            method: 'GET',
                            headers:{
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type':'application/json',
                            },
                            credentials:'include'
                        })
                        console.log(response);
                        this.franchise = response.franchises;
                    } catch (error) {
                        console.log(error);
                    }
                }
            }
        },
        async Franchise_put(formdata,id){
            try {
                 const response = await $fetch(`http://127.0.0.1:8000/api/franchise/${id}`,{
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
                console.log(response.error);
            }
        },
        async Franchise_delete(formdata){
            console.log(formdata);
            try {
                const response = await $fetch(`http://127.0.0.1:8000/api/franchise/${formdata}`,{
                    method: 'DELETE',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                return true
            } catch (error) {
                console.log(error.response);
                return false
            }
        },
        async Franchiste_get_edit(formdata){
            try {
                const response = await $fetch(`http://127.0.0.1:8000/api/franchise/${formdata}/edit`,{
                    method: 'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                this.franchise_edit= response.franchise;
                return response.franchise
            } catch (error) {
                console.log(error);
            }
        },
        async Franchise_get_tags(formdata){
            try {
                const response = await $fetch(`http://127.0.0.1:8000/api/franchise/${formdata}/tags`,{
                    method: 'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                this.franchise_edit_tags = response.tags_franchise
            } catch (error) {
                console.log(error.response);
            }
        },
        async Franchiste_edit_tags(formdata,id){
            console.log('id enviando a actualizar ' + id);
            console.log(formdata);
            try {
                const response = await $fetch(`http://127.0.0.1:8000/api/franchise/${id}/update_tags`,{
                    method: 'POST',
                    body: formdata,
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
            } catch (error) {
                console.log(error.response);
            }
        },
    },
})