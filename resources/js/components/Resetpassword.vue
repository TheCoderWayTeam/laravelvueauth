<template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Reset Password</h1>
                        <hr/>
                        <form action="javascript:void(0)" class="row" method="post">
                            <div class="form-group col-12 mb-2">
                                <label for="password" class="font-weight-bold">Password</label>
                                <input type="password" v-model="auth.password" name="password" id="password" class="form-control">
                                <input type="hidden" v-model="auth.token" name="token" id="token" class="form-control">
                            </div>
							<div class="form-group col-12 mb-2">
                                <label for="password" class="font-weight-bold">Confirm Password</label>
                                <input type="text" v-model="auth.password_confirmation" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>
                            <div class="col-12 mb-2  mt-2">
                                <button type="submit" :disabled="processing" @click="resetpassword" class="btn btn-primary btn-block">
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
                token:this.$route.params.token,
                password:"",
                password_confirmation:""
            },
            processing:false
        }
    },
    methods:{
        ...mapActions({
            signIn:'auth/login'
        }),
		async resetpassword(){
            this.processing = true
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/api/resetpassword',this.auth).then(({data})=>{
                this.$router.push({path: '/login'}) 
            }).catch(({response:{data}})=>{
                alert(data.message)
            }).finally(()=>{
                this.processing = false
            })
        },
    }
}
</script>