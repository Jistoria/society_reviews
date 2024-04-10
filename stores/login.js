export const LoginStore = defineStore('loginP',{
    state:()=>(
        {
            session:false,
            user:[ ],
            notificaciont_count:null,
            url: 'http://127.0.0.1:8000',
        }
    ),
    getters:{

    },
    actions:{
        async set_url(data){
            
        },
        async Login(formData){
            try {
                const data = await $fetch(`${this.url}/api/login`,{
                    method:'POST',
                    body:formData,
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include',
                })

                this.user = data.user;
                this.session = true;
                return true
            } catch (error) {
                console.log(error);
                return false
            }
        },
        async Logout(){
            try {
                const data = await $fetch(`${this.url}/api/logout`,{
                    method:'POST',
                    headers:{
                        'Content-Type': 'application/json', 
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    credentials:'include',
                })
                this.session = false;
                this.user=[];
                return true
            } catch (error) {
                
                return false

            }
        },
        async set_data(data_set){
            if(data_set == false){
                this.session = false;
                
            }else{
                this.session = true;
                this.user=data_set;

            }
    
        },
        async get_session_detail(){
            try {
                const data = await $fetch(`${this.url}/api/take`,{
                    method:'GET',
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include',
                })
                console.log(data)
            } catch (error) {
                console.log(error);
            }
        }

    }
})