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
        async get_data(){

            try {
                const response = await $fetch(`http://127.0.0.1:8000/api/paginate`,{
                    method: 'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                console.log(response);
                this.franchises = response.paginate;
                this.isfilter=false
                console.log(this.franchises);
            } catch (error) {
                console.log(error.response);
            }
        },
        async cover_paginate(page,search,formdata){
            console.log(page)
            console.log(search)
            console.log(formdata)
            //FUNCION PARA TRANSFORMAR EL FORMDATA EN PARAMS URL, ESTAN MAL SETEADOS Y SE MUESTRAN COMO OBJECTS
            //===> tags=%5Bobject+Object%5D%2C%5Bobject+Object%5D&authors=%5Bobject+Object%5D&content_type=&time=&rating=
            //COMO DEBE SER EJEMPLO
            // ===> description=Un%20cojudo%20y%20tres%20pendejas&tag_id%5B0%5D=1&tag_id%5B1%5D=2
            console.log(new URLSearchParams(formdata).toString());
            if(formdata || this.isfilter == true){
                this.isfilter==true;
                if(!formdata){
                    formdata == this.filters
                }else{
                    this.filters=formdata
                }
                if(search){
                    try {
                        if (this.coverSearch == null  || search !== this.coverSearch) {
                            this.coverSearch=search
                        }
                        
                        const response = await $fetch(`http://127.0.0.1:8000/api/paginate/${search}?page=${page}`+new URLSearchParams(formdata).toString(),{
                            method: 'GET',
                            headers:{
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type':'application/json',
                            },
                            credentials:'include'
                        })
                        console.log(response);
                        this.franchises = response.paginate;
                    } catch (error) {
                        console.log(error.response._data.errors);
                    }
                }else{
                    if(this.coverSearch == null){
                        try {
                            
                            const response = await $fetch(`http://127.0.0.1:8000/api/paginate?page=${page}`+new URLSearchParams(formdata).toString(),{
                                method: 'GET',
                                headers:{
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Content-Type':'application/json',
                                },
                                credentials:'include'
                            })
                            
                            console.log(response);
                            this.franchises = response.paginate;
                        } catch (error) {
                            console.log(error);
                        }
                    }else{
                        try {
                            search =this.coverSearch
                            console.log(search)
                            console.log(page)
                            const response = await $fetch(`http://127.0.0.1:8000/api/paginate/${search}?page=${page}`,{
                                method: 'GET',
                                body: formdata,
                                headers:{
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Content-Type':'application/json',
                                },
                                credentials:'include'
                            })
                            this.franchises = response.paginate;
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }
            }else{
                if(search){
                    try {
                        if (this.coverSearch == null  || search !== this.coverSearch) {
                            this.coverSearch=search
                        }
                        const response = await $fetch(`http://127.0.0.1:8000/api/paginate/${search}?page=${page}`,{
                            method: 'GET',
                            headers:{
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type':'application/json',
                            },
                            credentials:'include'
                        })
                        console.log(response);
                        this.franchises = response.paginate;
                    } catch (error) {
                        console.log(error.response._data.errors);
                    }
                }else{
                    if(this.coverSearch == null){
                        try {
                            const response = await $fetch(`http://127.0.0.1:8000/api/paginate?page=${page}`,{
                                method: 'GET',
                                headers:{
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Content-Type':'application/json',
                                },
                                credentials:'include'
                            })
                            console.log(response);
                            this.franchises = response.paginate;
                        } catch (error) {
                            console.log(error);
                        }
                    }else{
                        try {
                            search =this.coverSearch
                            console.log(search)
                            console.log(page)
                            const response = await $fetch(`http://127.0.0.1:8000/api/paginate/${search}?page=${page}`,{
                                method: 'GET',
                                headers:{
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Content-Type':'application/json',
                                },
                                credentials:'include'
                            })
                            this.franchises = response.paginate;
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }
            }
            
        }


    },

})