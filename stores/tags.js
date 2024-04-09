export const TagsAd = defineStore('TagsAd',{
    state:()=>(
        {
            prueba:'tomo',
            tags:[],
            url: null,
        }
    ),
    getters:{

    },
    actions:{
        async set_url(data){
            this.url = data;
            console.log(this.url);
        },
        async Tags_post(formdata){
            console.log(formdata);
            try {
                const response = await $fetch(`http://127.0.0.1:8000/api/tag`,{
                    method: 'POST',
                    body: formdata,
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                return response
            } catch (error) {
                console.log(error.response._data.message)
                return error.response._data
            }
        },
        async Tags_get(){
            try {
                const response = await $fetch(`${this.url}/api/tag`,{
                    method: 'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                this.tags = response.tags;
            } catch (error) {
                console.log(error.response);
            }
        },
        async Tags_pluck(){
            try {
                const response = await $fetch(`${this.url}/api/pluck/tags`,{
                    method: 'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                this.tags = response.tags;
            } catch (error) {
                console.log(error.response);
            }
        },
        async Tags_put(formdata,id){
            try {
                console.log(formdata)
                const response = await $fetch(`http://127.0.0.1:8000/api/tag/${id} `,{
                    method: 'PUT',
                    body: formdata,
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                console.log(response);
                return response
            }  catch (error) {
                console.log(error.response._data)
                return error.response._data
            }
        },
        async Tags_delete(id_tag){
            try {
                console.log(id_tag)
                const response = await $fetch(`http://127.0.0.1:8000/api/tag/${id_tag} `,{
                    method: 'DELETE',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                console.log(response);
                return response;
            } catch (error) {
                console.log(error.response._data.message)
                return error.response._data
            }
        }

    },
})