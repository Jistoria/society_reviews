export const TagsAd = defineStore('TagsAd',{
    state:()=>(
        {
            prueba:'tomo',
            tags:[],
        }
    ),
    getters:{

    },
    actions:{
        async Tags_post(formdata){
            console.log(formdata);
            try {
                const response = await $fetch('',{
                    method: 'POST',
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
        async Tags_get(){
            try {
                const response = await $fetch('http://127.0.0.1:8000/api/tag',{
                    method: 'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                this.tags = response.tags;
                console.log(this.tags);
            } catch (error) {
                
            }
        },
        async Tags_put(formdata){
            try {
                const response = await $fetch('',{
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
        async Tags_delete(){
            try {
                const response = await $fetch('',{
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
        }

    },
})