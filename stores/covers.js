export const coversE = defineStore('CoverE',{
    state:()=>(
        {
            isChecked: false,
            franchises:[]
        }
    ),
    getters:{

    },
    actions:{
        async filter(formdata){
            
        },
        async get_data(search){

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
                console.log(this.franchises);
            } catch (error) {
                console.log(error.response);
            }
        }


    },

})