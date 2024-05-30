<template>
  <div class="bg-white shadow p-4 py-8" x-data="{ images: [] }">
    <div class="heading text-center font-bold text-2xl m-5 text-gray-800 bg-white">New Post</div>
    <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
      <input
        class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none"
        spellcheck="false"
        placeholder="Title"
        type="text"
      />
      <textarea
        class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none"
        spellcheck="false"
        placeholder="Describe everything about this post here"
      ></textarea>

      <!-- icons -->
      <div class="icons flex text-gray-500 m-2">
        <label id="select-image">
          <svg
            class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
            />
          </svg>
          <input
            hidden
            type="file"
            multiple
            @change="handleFileChange"
            ref="fileInput"
          />
        </label>
        <div class="count ml-auto text-gray-400 text-xs font-semibold">0/300</div>
      </div>

      <!-- Preview image here -->
      <div id="preview" class="my-4 flex">
        <div
          v-for="(image, index) in images"
          :key="index"
          class="relative w-32 h-32 object-cover rounded"
        >
          <div v-if="image.preview" class="relative w-32 h-32 object-cover rounded">
            <img :src="image.url" class="w-32 h-32 object-cover rounded" />
            <button
              @click="removeImage(index)"
              class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"
            >
              <span class="mx-auto">×</span>
            </button>
            <div class="text-xs text-center p-2">{{ image.size }}</div>
          </div>
          <div
            v-else
            class="relative w-32 h-32 object-cover rounded"
          >
            <svg
              class="fill-current w-32 h-32 ml-auto pt-1"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
            >
              <path
                d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z"
              />
            </svg>
            <button
              @click="removeImage(index)"
              class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"
            >
              <span class="mx-auto">×</span>
            </button>
            <div class="text-xs text-center p-2">{{ image.size }}</div>
          </div>
        </div>
      </div>

      <!-- Buttons -->
      <div class="buttons flex justify-end">
        <div
          class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500"
        >
          Post
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">

interface Image {
  url: string;
  name: string;
  preview: boolean;
  size: string;
}

const images = ref<Image[]>([]);

const handleFileChange = (event: Event) => {
  const target = event.target as HTMLInputElement;
  if (target.files) {
    const files = Array.from(target.files);
    images.value = files.map((file) => ({
      url: URL.createObjectURL(file),
      name: file.name,
      preview: ['jpg', 'jpeg', 'png', 'gif'].includes(file.name.split('.').pop()!.toLowerCase()),
      size: file.size > 1024 ? (file.size > 1048576 ? Math.round(file.size / 1048576) + 'mb' : Math.round(file.size / 1024) + 'kb') : file.size + 'b',
    }));
  }
};

const removeImage = (index: number) => {
  images.value.splice(index, 1);
};
</script>

<style scoped>
</style>
