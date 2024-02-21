export const VerificacionE = defineStore('emailVerificacion',{
    state:()=>(
        {
            isChecked: false
        }
    ),
    getters:{

    },
    actions:{
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
        }
    },
})