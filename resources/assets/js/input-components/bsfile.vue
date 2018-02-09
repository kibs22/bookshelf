<template>

    <div class="form-group" v-bind:class="{'text-danger': error.length}">
        <label class="control-label" v-bind:for="id">{{ label }}</label>
        <input type="file" class="" v-bind:class="inputClass" v-bind:id="id" v-on:change="fileChanged($event)">
        <span v-show="error" class="help-block" >{{ error[0] }}</span>
    </div>




</template>

<script>
    export default {
        props: {
            label: {
                type: String,
                default: ''
            },
            id: {
                type: String,
                default: ''
            },
            type: {
                type: String,
                default: 'text'
            },
            'input-class':  {
                type: String,
                default: ''
            },
            error: {
                // type: Object,
                default: ''
            }
           
        },
        methods: {
            fileChanged(event) {
                this.$emit('input', event.target.files[0])
            },
            
        }
    }
</script>