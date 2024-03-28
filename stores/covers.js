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
                    method: 'POST',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                console.log(response);
                this.franchises = response.paginate;
                this.isfilter=false
                this.coverSearch=null
                console.log(this.franchises);
            } catch (error) {
                console.log(error.response);
            }
        },
        async cover_paginate(page, search, formdata) {
            console.log(page, "Empiezo")
            console.log(search)
            
            // Verificar si se proporciona formdata o si se está utilizando un filtro
            if (formdata || this.isfilter == true) {
                this.isfilter=true;
                // Si no se proporciona formdata pero hay filtros aplicados, usar los filtros existentes
                if (!formdata) {
                    formdata = this.filters
                    console.log(formdata)
                } else {
                    // Si se proporciona formdata, actualizar los filtros
                    this.filters=formdata
                }
        
                // Si hay una búsqueda, realizar la llamada con la búsqueda
                if (search) {
                    try {
                        // Verificar si la búsqueda ha cambiado para evitar llamadas redundantes
                        if (this.coverSearch == null || search !== this.coverSearch) {
                            this.coverSearch=search
                        }
                        
                        // Realizar la llamada a la API con la búsqueda y los filtros
                        const response = await $fetch(`http://127.0.0.1:8000/api/paginate/${search}?page=${page}`,{
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
                        console.log(error.response._data.errors);
                    }
                } else {
                    // Si no hay búsqueda, realizar la llamada con los filtros y sin búsqueda
                    if(this.coverSearch == null){
                        try {
                            const response = await $fetch(`http://127.0.0.1:8000/api/paginate?page=${page}`,{
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
                            console.log(error);
                        }
                    } else {
                        // Si hay una búsqueda anterior, realizar la llamada con la búsqueda y los filtros
                        try {
                            search = this.coverSearch
                            console.log(search)
                            console.log(page)
                            const response = await $fetch(`http://127.0.0.1:8000/api/paginate/${search}?page=${page}`,{
                                method: 'POST',
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
            } else {
                // Si no se proporciona formdata y no hay filtros aplicados
                if (search) {
                    try {
                        // Verificar si la búsqueda ha cambiado para evitar llamadas redundantes
                        if (this.coverSearch == null || search !== this.coverSearch) {
                            this.coverSearch=search
                        }
                        // Realizar la llamada a la API con la búsqueda
                        const response = await $fetch(`http://127.0.0.1:8000/api/paginate/${search}?page=${page}`,{
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
                        console.log(error.response._data.errors);
                    }
                } else {
                    // Si no hay búsqueda, realizar la llamada sin búsqueda ni filtros
                    if (this.coverSearch == null) {
                        try {
                            const response = await $fetch(`http://127.0.0.1:8000/api/paginate?page=${page}`,{
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
                            console.log(error);
                        }
                    } else {
                        // Si hay una búsqueda anterior, realizar la llamada con la búsqueda y sin filtros
                        try {
                            search = this.coverSearch
                            console.log(search)
                            console.log(page)
                            const response = await $fetch(`http://127.0.0.1:8000/api/paginate/${search}?page=${page}`,{
                                method: 'POST',
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
            }
            console.log("acabo")
        }
        
    },

})