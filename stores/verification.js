export const VerificacionE = defineStore('emailVerificacion',{
    state:()=>(
        {
            isChecked: false,
            url: null,
        }
    ),
    getters:{

    },
    actions:{
        async set_url(data){
            this.url = data;
        },
        async check(Formdata){
            try {
                const data  = await $fetch(`http://127.0.0.1:8000/api/email/verify/${Formdata.id}/${Formdata.hash}`, {
                    method: 'GET',
                })
            } catch (error) {
                throw error
            }
        },
        async background(){
            this.isChecked = !this.isChecked;
        },

    },

})