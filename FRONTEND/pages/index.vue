<template>
    <div>
        <!-- <p>bienvenido</p> -->
        <!-- <ClientOnly fallback-tag="span" fallback="Loading comments..."> -->
            <div class="mt-20 container mx-auto bg-white rounded p-2 shadow" style="z-index: 0;">
                <Table url="http://localhost:8000/api/user/get"></Table>

            </div>
        <!-- </ClientOnly> -->
    </div>
</template>
<style scoped></style>

<script setup lang="ts">
</script>