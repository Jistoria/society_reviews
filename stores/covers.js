export const coversE = defineStore('CoverE',{
    state:()=>(
        {
            isChecked: false,
            franchises:[],
            coverSearch:null,
            isfilter:false,
            filters:[]
        }
    ),
    getters:{

    },
    actions:{
        async filter(formdata){
            
        },
        async clear_filter(){
           this.filters = []
        },
        async get_data(){
            if(this.filters.length === 0){
                try {
                    const response = await $fetch(`http://127.0.0.1:8000/api/paginate`,{
                        method: 'POST',
                        headers:{
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type':'application/json',
                        },
                        credentials:'include'
                    })
                    this.franchises = response.paginate;
                    console.log(this.franchises);
                    return
                } catch (error) {
                    console.log(error.response);
                }
            }else{
                try {
                    const formdata = this.filters
                    const response = await $fetch(`http://127.0.0.1:8000/api/paginate`,{
                        method: 'POST',
                        body: formdata,
                        headers:{
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type':'application/json',
                        },
                        credentials:'include'
                    })
                    console.log(response);
                    this.franchises = response.paginate;
                } catch (error) {
                    console.log(error.response);
                }
            }
            
        },
        async cover_paginate(page,search,formdata=this.filters){
            if(search==null && this.coverSearch!=null){
                search=this.coverSearch
            }
            let url = `http://127.0.0.1:8000/api/paginate${search ? `/${search}` : ''}?page=${page}`;
            try {
                // Realizar la solicitud a la API
                const response = await $fetch(url, {
                    method: 'POST',
                    body: formdata,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                    credentials: 'include'

                });
                if(response.search!=null){
                    console.log("Devuelve algo")
                    this.coverSearch = response.search;
                }
                this.filters = response.request;
                this.franchises = response.paginate;
                return;
            } catch (error) {
                // Manejar errores de la solicitud
                console.log(error.response._data.errors);
            }
        }
        
    },

})