<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 24 24"
  >
    <g>
      <path
        d="M21,6l-6-6H5C3.8954306,0,3,0.8954305,3,2v20c0,1.1045704,0.8954306,2,2,2h14c1.1045704,0,2-0.8954296,2-2   V6z"
        fill="#19B870"
      /><linearGradient
        id="SVGID_1_"
        gradientUnits="userSpaceOnUse"
        x1="16.80896"
        x2="22.2063599"
        y1="4.2216797"
        y2="9.6190796"
      >
        <stop
          offset="0"
          style="stop-color:#000000;stop-opacity:0.1"
        /><stop
          offset="1"
          style="stop-color:#000000;stop-opacity:0"
        />
      </linearGradient><path
        d="M17,6c-0.5444336,0-1.0367432-0.2190552-1.3973999-0.5719604L21,10.8254395V6H17z"
        fill="url(#SVGID_1_)"
      /><path
        d="M19,23.75H5c-1.1045532,0-2-0.8954468-2-2V22c0,1.1045532,0.8954468,2,2,2h14c1.1045532,0,2-0.8954468,2-2   v-0.25C21,22.8545532,20.1045532,23.75,19,23.75z"
        opacity="0.1"
      /><path
        d="M15,0v4c0,1.1045694,0.8954306,2,2,2h4L15,0z"
        fill="#80D8B0"
      /><path
        d="M17,5.75c-1.1045532,0-2-0.8954468-2-2V4c0,1.1045532,0.8954468,2,2,2h4l-0.25-0.25H17z"
        opacity="0.1"
      /><path
        d="M15,0H5C3.8954468,0,3,0.8953857,3,2v0.25c0-1.1046143,0.8954468-2,2-2h10"
        fill="#FFFFFF"
        opacity="0.2"
      /><path
        d="M7,9v10h10V9H7z M16,12h-3.5v-2H16V12z M12.5,13H16v2h-3.5V13z M11.5,15H8v-2h3.5V15z M11.5,10v2H8v-2H11.5   z M8,16h3.5v2H8V16z M12.5,18v-2H16v2H12.5z"
        fill="#FFFFFF"
      /><linearGradient
        id="SVGID_2_"
        gradientUnits="userSpaceOnUse"
        x1="0.2100637"
        x2="22.9961185"
        y1="7.5385189"
        y2="18.1638298"
      >
        <stop
          offset="0"
          style="stop-color:#FFFFFF;stop-opacity:0.2"
        /><stop
          offset="1"
          style="stop-color:#FFFFFF;stop-opacity:0"
        />
      </linearGradient><path
        d="M21,6l-6-6H5C3.8954306,0,3,0.8954305,3,2v20c0,1.1045704,0.8954306,2,2,2h14   c1.1045704,0,2-0.8954296,2-2V6z"
        fill="url(#SVGID_2_)"
      />
    </g>
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from '../../../Components/FormBuilder/Icons/IconBase'

export default {
  name: 'GoogleSheetsIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>

</style>
