export const FranchiseAd = defineStore('franchiseAd',{
    state:()=>(
        {
            franchise:[]
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
            } catch (error) {
                console.log(error);
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
                console.log(response);
                this.franchise = response.franchises;
            } catch (error) {
                console.log(error);
            }
        },
        async Franchise_put(formdata){
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
        async Franchise_delete(){
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