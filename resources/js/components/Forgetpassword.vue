<template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Forget Password</h1>
                        <hr/>
                        <form action="javascript:void(0)" class="row" method="post">
                            <div class="form-group col-12 mb-2">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="text" v-model="auth.email" name="email" id="email" class="form-control">
                            </div>
                            <div class="col-12 mb-2  mt-2">
                                <button type="submit" :disabled="processing" @click="forgetpassword" class="btn btn-primary btn-block">
                                    {{ processing ? "Please wait" : "Reset Password" }}
                                </button>
                            </div>
                            <div class="col-12 text-center mb-2">
                                <label>Don't have an account? <router-link :to="{name:'register'}">Register Now!</router-link></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'
export default {
    name:"login",
    data(){
        return {
            auth:{
                email:""
            },
            processing:false
        }
    },
    methods:{
		async forgetpassword(){
            this.processing = true
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/api/forgetpassword',this.auth).then(({data})=>{
                
            }).catch(({response:{data}})=>{
                alert(data.message)
            }).finally(()=>{
                this.processing = false
            })
        },
    }
}
</script>