export const ReviewAd = defineStore('ReviewAd',{
    state:()=>(
        {

        }
    ),
    getters:{

    },
    actions:{
        async Review_post(formdata){
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
        async Review_get(){
            try {
                const response = await $fetch('',{
                    method: 'GET',
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
        async Review_put(formdata){
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
        async Review_delete(){
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