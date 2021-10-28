<template>
    <div>
        <h3 class="text-center">Editar Marca</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateMarca">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" v-model="marca.nombre">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                marca: {}
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/marcas/${this.$route.params.id}`)
                .then((res) => {
                    this.marca = res.data;
                });
        },
        methods: {
            updateMarca() {
                this.axios
                    .patch(`http://localhost:8000/api/marcas/${this.$route.params.id}`, this.marca)
                    .then((res) => {
                        this.$router.push({ name: 'marca_list' });
                    });
            }
        }
    }
</script>