<template>
    <div class="container"> 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse align-content-end">
                <div class="navbar-nav">
                    <router-link to="/marcas" class="nav-item nav-link">Marcas</router-link>
                    <router-link to="/modelos" class="nav-item nav-link">Modelos</router-link>
                    <router-link to="/tipov" class="nav-item nav-link">Tipo Vehículos</router-link>
                </div>
            </div>
        </nav>

        <router-view> </router-view>
    </div>
</template>
 
<script>
    export default {}
</script>