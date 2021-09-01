<template>
    <div class="flex justify-between items-center">
        <h1 class="text-2xl">
            {{name}}
        </h1>
        <slot></slot>
    </div>
</template>

<script lang="ts">
export default {
    props: {
        name: {
            type: String,
            required:true
        }
    }
}
</script>