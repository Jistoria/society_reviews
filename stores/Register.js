export const RegisterStore = defineStore('RegisterP',{
    state:()=>(
        {

        }
    ),
    getters:{

    },
    actions:{
        async Register(Formdata){
            try {
                const data = await $fetch('http://127.0.0.1:8000/api/register',{
                    method: 'POST',
                    body: Formdata,
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
            } catch (error) {
                console.log(error);
            }
        },
    },
})