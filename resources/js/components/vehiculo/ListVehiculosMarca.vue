<template>
    <div>
        <h2 class="text-center">Vehiculos por Marcas</h2>
        <div class="col-md-12 table-responsive">
            <table class="table" >
                <thead>
                <tr>
                    <th>Marca</th>
                    <th>Cantidad de Vehiculos</th>
                </tr>
                </thead>
                <tbody v-if="verificarListado">
                    <tr v-for="marca in marcas" :key="marca.id">
                        <td>{{ marca.nombre }}</td>
                        <td>{{ marca.canti_vehi }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                marcas: []
            }
        },
        computed: {
            verificarListado() {
                return this.marcas.length > 0
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/vehiculos-by-marca/')
                .then(response => {
                    this.marcas = response.data;
                });
        },
        methods: {
        }
    }
</script>