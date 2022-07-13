<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Dashboard</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">Email : <b>{{user.email}}</b></p>
                        <p class="mb-0">Name : <b>{{user.name}}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    name:"profile",
    data(){
        return {
            user:this.$store.state.auth.user
        }
    }
}
</script>