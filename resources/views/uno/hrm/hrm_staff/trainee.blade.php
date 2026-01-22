<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Schedule Training - Monti Textile HRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */@layer theme{:root,:host{--font-sans:'Instrument Sans',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-serif:ui-serif,Georgia,Cambria,"Times New Roman",Times,serif;--font-mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier Newmonospace";--color-red-50:oklch(.971 .013 17.38);--color-red-100:oklch(.936 .032 17.717);--color-red-200:oklch(.885 .062 18.334);--color-red-300:oklch(.808 .114 19.571);--color-red-400:oklch(.704 .191 22.216);--color-red-500:oklch(.637 .237 25.331);--color-red-600:oklch(.577 .245 27.325);--color-red-700:oklch(.505 .213 27.518);--color-red-800:oklch(.444 .177 26.899);--color-red-900:oklch(.396 .141 25.723);--color-red-950:oklch(.258 .092 26.042);--color-orange-50:oklch(.98 .016 73.684);--color-orange-100:oklch(.954 .038 75.164);--color-orange-200:oklch(.901 .076 70.697);--color-orange-300:oklch(.837 .128 66.29);--color-orange-400:oklch(.75 .183 55.934);--color-orange-500:oklch(.705 .213 47.604);--color-orange-600:oklch(.646 .222 41.116);--color-orange-700:oklch(.553 .195 38.402);--color-orange-800:oklch(.47 .157 37.304);--color-orange-900:oklch(.408 .123 38.172);--color-orange-950:oklch(.266 .079 36.259);--color-amber-50:oklch(.987 .022 95.277);--color-amber-100:oklch(.962 .059 95.617);--color-amber-200:oklch(.924 .12 95.746);--color-amber-300:oklch(.879 .169 91.605);--color-amber-400:oklch(.828 .189 84.429);--color-amber-500:oklch(.769 .188 70.08);--color-amber-600:oklch(.666 .179 58.318);--color-amber-700:oklch(.555 .163 48.998);--color-amber-800:oklch(.473 .137 46.201);--color-amber-900:oklch(.414 .112 45.904);--color-amber-950:oklch(.279 .077 45.635);--color-yellow-50:oklch(.987 .026 102.212);--color-yellow-100:oklch(.973 .071 103.193);--color-yellow-200:oklch(.945 .129 101.54);--color-yellow-300:oklch(.905 .182 98.111);--color-yellow-400:oklch(.852 .199 91.936);--color-yellow-500:oklch(.795 .184 86.047);--color-yellow-600:oklch(.681 .162 75.834);--color-yellow-700:oklch(.554 .135 66.442);--color-yellow-800:oklch(.476 .114 61.907);--color-yellow-900:oklch(.421 .095 57.708);--color-yellow-950:oklch(.286 .066 53.813);--color-lime-50:oklch(.986 .031 120.757);--color-lime-100:oklch(.967 .067 122.328);--color-lime-200:oklch(.938 .127 124.321);--color-lime-300:oklch(.897 .196 126.665);--color-lime-400:oklch(.841 .238 128.85);--color-lime-500:oklch(.768 .233 130.85);--color-lime-600:oklch(.648 .2 131.684);--color-lime-700:oklch(.532 .157 131.589);--color-lime-800:oklch(.453 .124 130.933);--color-lime-900:oklch(.405 .101 131.063);--color-lime-950:oklch(.274 .072 132.109);--color-green-50:oklch(.982 .018 155.826);--color-green-100:oklch(.962 .044 156.743);--color-green-200:oklch(.925 .084 155.995);--color-green-300:oklch(.871 .15 154.449);--color-green-400:oklch(.792 .209 151.711);--color-green-500:oklch(.723 .219 149.579);--color-green-600:oklch(.627 .194 149.214);--color-green-700:oklch(.527 .154 150.069);--color-green-800:oklch(.448 .119 151.328);--color-green-900:oklch(.393 .095 152.535);--color-green-950:oklch(.266 .065 152.934);--color-emerald-50:oklch(.979 .021 166.113);--color-emerald-100:oklch(.95 .052 163.051);--color-emerald-200:oklch(.905 .093 164.15);--color-emerald-300:oklch(.845 .143 164.978);--color-emerald-400:oklch(.765 .177 163.223);--color-emerald-500:oklch(.696 .17 162.48);--color-emerald-600:oklch(.596 .145 163.225);--color-emerald-700:oklch(.508 .118 165.612);--color-emerald-800:oklch(.432 .095 166.913);--color-emerald-900:oklch(.378 .077 168.94);--color-emerald-950:oklch(.262 .051 172.552);--color-teal-50:oklch(.984 .014 180.72);--color-teal-100:oklch(.953 .051 180.801);--color-teal-200:oklch(.91 .096 180.426);--color-teal-300:oklch(.855 .138 181.071);--color-teal-400:oklch(.777 .152 181.912);--color-teal-500:oklch(.704 .14 182.503);--color-teal-600:oklch(.6 .118 184.704);--color-teal-700:oklch(.511 .096 186.391);--color-teal-800:oklch(.437 .078 188.216);--color-teal-900:oklch(.386 .063 188.416);--color-teal-950:oklch(.277 .046 192.524);--color-cyan-50:oklch(.984 .019 200.873);--color-cyan-100:oklch(.956 .045 203.388);--color-cyan-200:oklch(.917 .08 205.041);--color-cyan-300:oklch(.865 .127 207.078);--color-cyan-400:oklch(.789 .154 211.53);--color-cyan-500:oklch(.715 .143 215.221);--color-cyan-600:oklch(.609 .126 221.723);--color-cyan-700:oklch(.52 .105 223.128);--color-cyan-800:oklch(.45 .085 224.283);--color-cyan-900:oklch(.398 .07 227.392);--color-cyan-950:oklch(.302 .056 229.695);--color-sky-50:oklch(.977 .013 236.62);--color-sky-100:oklch(.951 .026 236.824);--color-sky-200:oklch(.901 .058 230.902);--color-sky-300:oklch(.828 .111 230.318);--color-sky-400:oklch(.746 .16 232.661);--color-sky-500:oklch(.685 .169 237.323);--color-sky-600:oklch(.588 .158 241.966);--color-sky-700:oklch(.5 .134 242.749);--color-sky-800:oklch(.443 .11 240.79);--color-sky-900:oklch(.391 .09 240.876);--color-sky-950:oklch(.293 .066 243.157);--color-blue-50:oklch(.97 .014 254.604);--color-blue-100:oklch(.932 .032 255.585);--color-blue-200:oklch(.882 .059 254.128);--color-blue-300:oklch(.809 .105 251.813);--color-blue-400:oklch(.707 .165 254.624);--color-blue-500:oklch(.623 .214 259.815);--color-blue-600:oklch(.546 .245 262.881);--color-blue-700:oklch(.488 .243 264.376);--color-blue-800:oklch(.424 .199 265.638);--color-blue-900:oklch(.379 .146 265.522);--color-blue-950:oklch(.282 .091 267.935);--color-indigo-50:oklch(.962 .018 272.314);--color-indigo-100:oklch(.93 .034 272.788);--color-indigo-200:oklch(.87 .065 274.039);--color-indigo-300:oklch(.785 .115 274.713);--color-indigo-400:oklch(.673 .182 276.935);--color-indigo-500:oklch(.585 .233 277.117);--color-indigo-600:oklch(.511 .262 276.966);--color-indigo-700:oklch(.457 .24 277.023);--color-indigo-800:oklch(.398 .195 277.366);--color-indigo-900:oklch(.359 .144 278.697);--color-indigo-950:oklch(.257 .09 281.288);--color-violet-50:oklch(.969 .016 293.756);--color-violet-100:oklch(.943 .029 294.588);--color-violet-200:oklch(.894 .057 293.283);--color-violet-300:oklch(.811 .111 293.571);--color-violet-400:oklch(.702 .183 293.541);--color-violet-500:oklch(.606 .25 292.717);--color-violet-600:oklch(.541 .281 293.009);--color-violet-700:oklch(.491 .27 292.581);--color-violet-800:oklch(.432 .232 292.759);--color-violet-900:oklch(.38 .189 293.745);--color-violet-950:oklch(.283 .141 291.089);--color-purple-50:oklch(.977 .014 308.299);--color-purple-100:oklch(.946 .033 307.174);--color-purple-200:oklch(.902 .063 306.703);--color-purple-300:oklch(.827 .119 306.383);--color-purple-400:oklch(.714 .203 305.504);--color-purple-500:oklch(.627 .265 303.9);--color-purple-600:oklch(.558 .288 302.321);--color-purple-700:oklch(.496 .265 301.924);--color-purple-800:oklch(.438 .218 303.724);--color-purple-900:oklch(.381 .176 304.987);--color-purple-950:oklch(.291 .149 302.717);--color-fuchsia-50:oklch(.977 .017 320.058);--color-fuchsia-100:oklch(.952 .037 318.852);--color-fuchsia-200:oklch(.903 .076 319.62);--color-fuchsia-300:oklch(.833 .145 321.434);--color-fuchsia-400:oklch(.74 .238 322.16);--color-fuchsia-500:oklch(.667 .295 322.15);--color-fuchsia-600:oklch(.591 .293 322.896);--color-fuchsia-700:oklch(.518 .253 323.949);--color-fuchsia-800:oklch(.452 .211 324.591);--color-fuchsia-900:oklch(.401 .17 325.612);--color-fuchsia-950:oklch(.293 .136 325.661);--color-pink-50:oklch(.971 .014 343.198);--color-pink-100:oklch(.948 .028 342.258);--color-pink-200:oklch(.899 .061 343.231);--color-pink-300:oklch(.823 .12 346.018);--color-pink-400:oklch(.718 .202 349.761);--color-pink-500:oklch(.656 .241 354.308);--color-pink-600:oklch(.592 .249 .584);--color-pink-700:oklch(.525 .223 3.958);--color-pink-800:oklch(.459 .187 3.815);--color-pink-900:oklch(.408 .153 2.432);--color-pink-950:oklch(.284 .109 3.907);--color-rose-50:oklch(.969 .015 12.422);--color-rose-100:oklch(.941 .03 12.58);--color-rose-200:oklch(.892 .058 10.001);--color-rose-300:oklch(.81 .117 11.638);--color-rose-400:oklch(.712 .194 13.428);--color-rose-500:oklch(.645 .246 16.439);--color-rose-600:oklch(.586 .253 17.585);--color-rose-700:oklch(.514 .222 16.935);--color-rose-800:oklch(.455 .188 13.697);--color-rose-900:oklch(.41 .159 10.272);--color-rose-950:oklch(.271 .105 12.094);--color-slate-50:oklch(.984 .003 247.858);--color-slate-100:oklch(.968 .007 247.896);--color-slate-200:oklch(.929 .013 255.508);--color-slate-300:oklch(.869 .022 252.894);--color-slate-400:oklch(.704 .04 256.788);--color-slate-500:oklch(.554 .046 257.417);--color-slate-600:oklch(.446 .043 257.281);--color-slate-700:oklch(.372 .044 257.287);--color-slate-800:oklch(.279 .041 260.031);--color-slate-900:oklch(.208 .042 265.755);--color-slate-950:oklch(.129 .042 264.695);--color-gray-50:oklch(.985 .002 247.839);--color-gray-100:oklch(.967 .003 264.542);--color-gray-200:oklch(.928 .006 264.531);--color-gray-300:oklch(.872 .01 258.338);--color-gray-400:oklch(.707 .022 261.325);--color-gray-500:oklch(.551 .027 264.364);--color-gray-600:oklch(.446 .03 256.802);--color-gray-700:oklch(.373 .034 259.733);--color-gray-800:oklch(.278 .033 256.848);--color-gray-900:oklch(.21 .034 264.665);--color-gray-950:oklch(.13 .028 261.692);--color-zinc-50:oklch(.985 0 0);--color-zinc-100:oklch(.967 .001 286.375);--color-zinc-200:oklch(.92 .004 286.32);--color-zinc-300:oklch(.871 .006 286.286);--color-zinc-400:oklch(.705 .015 286.067);--color-zinc-500:oklch(.552 .016 285.938);--color-zinc-600:oklch(.442 .017 285.786);--color-zinc-700:oklch(.37 .013 285.805);--color-zinc-800:oklch(.274 .006 286.033);--color-zinc-900:oklch(.21 .006 285.885);--color-zinc-950:oklch(.141 .005 285.823);--color-neutral-50:oklch(.985 0 0);--color-neutral-100:oklch(.97 0 0);--color-neutral-200:oklch(.922 0 0);--color-neutral-300:oklch(.87 0 0);--color-neutral-400:oklch(.708 0 0);--color-neutral-500:oklch(.556 0 0);--color-neutral-600:oklch(.439 0 0);--color-neutral-700:oklch(.371 0 0);--color-neutral-800:oklch(.269 0 0);--color-neutral-900:oklch(.205 0 0);--color-neutral-950:oklch(.145 0 0);--color-stone-50:oklch(.985 .001 106.423);--color-stone-100:oklch(.97 .001 106.424);--color-stone-200:oklch(.923 .003 48.717);--color-stone-300:oklch(.869 .005 56.366);--color-stone-400:oklch(.709 .01 56.259);--color-stone-500:oklch(.553 .013 58.071);--color-stone-600:oklch(.444 .011 73.639);--color-stone-700:oklch(.374 .01 67.558);--color-stone-800:oklch(.268 .007 34.298);--color-stone-900:oklch(.216 .006 56.043);--color-stone-950:oklch(.147 .004 49.25);--color-black:#000;--color-white:#fff;--spacing:.25rem;--breakpoint-sm:40rem;--breakpoint-md:48rem;--breakpoint-lg:64rem;--breakpoint-xl:80rem;--breakpoint-2xl:96rem;--container-3xs:16rem;--container-2xs:18rem;--container-xs:20rem;--container-sm:24rem;--container-md:28rem;--container-lg:32rem;--container-xl:36rem;--container-2xl:42rem;--container-3xl:48rem;--container-4xl:56rem;--container-5xl:64rem;--container-6xl:72rem;--container-7xl:80rem;--text-xs:.75rem;--text-xs--line-height:calc(1/.75);--text-sm:.875rem;--text-sm--line-height:calc(1.25/.875);--text-base:1rem;--text-base--line-height: 1.5 ;--text-lg:1.125rem;--text-lg--line-height:calc(1.75/1.125);--text-xl:1.25rem;--text-xl--line-height:calc(1.75/1.25);--text-2xl:1.5rem;--text-2xl--line-height:calc(2/1.5);--text-3xl:1.875rem;--text-3xl--line-height: 1.2 ;--text-4xl:2.25rem;--text-4xl--line-height:calc(2.5/2.25);--text-5xl:3rem;--text-5xl--line-height:1;--text-6xl:3.75rem;--text-6xl--line-height:1;--text-7xl:4.5rem;--text-7xl--line-height:1;--text-8xl:6rem;--text-8xl--line-height:1;--text-9xl:8rem;--text-9xl--line-height:1;--font-weight-thin:100;--font-weight-extralight:200;--font-weight-light:300;--font-weight-normal:400;--font-weight-medium:500;--font-weight-semibold:600;--font-weight-bold:700;--font-weight-extrabold:800;--font-weight-black:900;--tracking-tighter:-.05em;--tracking-tight:-.025em;--tracking-normal:0em;--tracking-wide:.025em;--tracking-wider:.05em;--tracking-widest:.1em;--leading-tight:1.25;--leading-snug:1.375;--leading-normal:1.5;--leading-relaxed:1.625;--leading-loose:2;--radius-xs:.125rem;--radius-sm:.25rem;--radius-md:.375rem;--radius-lg:.5rem;--radius-xl:.75rem;--radius-2xl:1rem;--radius-3xl:1.5rem;--radius-4xl:2rem;--shadow-2xs:0 1px #0000000d;--shadow-xs:0 1px 2px 0 #0000000d;--shadow-sm:0 1px 3px 0 #0000001a,0 1px 2px -1px #0000001a;--shadow-md:0 4px 6px -1px #0000001a,0 2px 4px -2px #0000001a;--shadow-lg:0 10px 15px -3px #0000001a,0 4px 6px -4px #0000001a;--shadow-xl:0 20px 25px -5px #0000001a,0 8px 10px -6px #0000001a;--shadow-2xl:0 25px 50px -12px #00000040;--inset-shadow-2xs:inset 0 1px #0000000d;--inset-shadow-xs:inset 0 1px 1px #0000000d;--inset-shadow-sm:inset 0 2px 4px #0000000d;--drop-shadow-xs:0 1px 1px #0000000d;--drop-shadow-sm:0 1px 2px #00000026;--drop-shadow-md:0 3px 3px #0000001f;--drop-shadow-lg:0 4px 4px #00000026;--drop-shadow-xl:0 9px 7px #0000001a;--drop-shadow-2xl:0 25px 25px #00000026;--ease-in:cubic-bezier(.4,0,1,1);--ease-out:cubic-bezier(0,0,.2,1);--ease-in-out:cubic-bezier(.4,0,.2,1);--animate-spin:spin 1s linear infinite;--animate-ping:ping 1s cubic-bezier(0,0,.2,1)infinite;--animate-pulse:pulse 2s cubic-bezier(.4,0,.6,1)infinite;--animate-bounce:bounce 1s infinite;--blur-xs:4px;--blur-sm:8px;--blur-md:12px;--blur-lg:16px;--blur-xl:24px;--blur-2xl:40px;--blur-3xl:64px;--perspective-dramatic:100px;--perspective-near:300px;--perspective-normal:500px;--perspective-midrange:800px;--perspective-distant:1200px;--aspect-video:16/9;--default-transition-duration:.15s;--default-transition-timing-function:cubic-bezier(.4,0,.2,1);--default-font-family:var(--font-sans);--default-font-feature-settings:var(--font-sans--font-feature-settings);--default-font-variation-settings:var(--font-sans--font-variation-settings);--default-mono-font-family:var(--font-mono);--default-mono-font-feature-settings:var(--font-mono--font-feature-settings);--default-mono-font-variation-settings:var(--font-mono--font-variation-settings)}}@layer base{*,:after,:before,::backdrop{box-sizing:border-box;border:0 solid;margin:0;padding:0}::file-selector-button{box-sizing:border-box;border:0 solid;margin:0;padding:0}html,:host{-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;line-height:1.5;font-family:var(--default-font-family,ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji");font-feature-settings:var(--default-font-feature-settings,normal);font-variation-settings:var(--default-font-variation-settings,normal);-webkit-tap-highlight-color:transparent}body{line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;-webkit-text-decoration:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,samp,pre{font-family:var(--default-mono-font-family,ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier Newmonospace");font-feature-settings:var(--default-mono-font-feature-settings,normal);font-variation-settings:var(--default-mono-font-variation-settings,normal);font-size:1em}small{font-size:80%}sub,sup{vertical-align:baseline;font-size:75%;line-height:0;position:relative}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}:-moz-focusring{outline:auto}progress{vertical-align:baseline}summary{display:list-item}ol,ul,menu{list-style:none}img,svg,video,canvas,audio,iframe,embed,object{vertical-align:middle;display:block}img,video{max-width:100%;height:auto}button,input,select,optgroup,textarea{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}::file-selector-button{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}:where(select:is([multiple],[size])) optgroup{font-weight:bolder}:where(select:is([multiple],[size])) optgroup option{padding-inline-start:20px}::file-selector-button{margin-inline-end:4px}::placeholder{opacity:1;color:color-mix(in oklab,currentColor 50%,transparent)}textarea{resize:vertical}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-date-and-time-value{min-height:1lh;text-align:inherit}::-webkit-datetime-edit{display:inline-flex}::-webkit-datetime-edit-fields-wrapper{padding:0}::-webkit-datetime-edit{padding-block:0}::-webkit-datetime-edit-year-field{padding-block:0}::-webkit-datetime-edit-month-field{padding-block:0}::-webkit-datetime-edit-day-field{padding-block:0}::-webkit-datetime-edit-hour-field{padding-block:0}::-webkit-datetime-edit-minute-field{padding-block:0}::-webkit-datetime-edit-second-field{padding-block:0}::-webkit-datetime-edit-millisecond-field{padding-block:0}::-webkit-datetime-edit-meridiem-field{padding-block:0}:-moz-ui-invalid{box-shadow:none}button,input:where([type=button],[type=reset],[type=submit]){-webkit-appearance:button;-moz-appearance:button;appearance:button}::file-selector-button{-webkit-appearance:button;-moz-appearance:button;appearance:button}::-webkit-inner-spin-button{height:auto}::-webkit-outer-spin-button{height:auto}[hidden]:where(:not([hidden=until-found])){display:none!important}}@layer components;@layer utilities{.absolute{position:absolute}.relative{position:relative}.static{position:static}.inset-0{inset:calc(var(--spacing)*0)}.-mt-\[4\.9rem\]{margin-top:-4.9rem}.-mb-px{margin-bottom:-1px}.mb-1{margin-bottom:calc(var(--spacing)*1)}.mb-2{margin-bottom:calc(var(--spacing)*2)}.mb-4{margin-bottom:calc(var(--spacing)*4)}.mb-6{margin-bottom:calc(var(--spacing)*6)}.-ml-8{margin-left:calc(var(--spacing)*-8)}.flex{display:flex}.hidden{display:none}.inline-block{display:inline-block}.inline-flex{display:inline-flex}.table{display:table}.aspect-\[335\/376\]{aspect-ratio:335/376}.h-1{height:calc(var(--spacing)*1)}.h-1\.5{height:calc(var(--spacing)*1.5)}.h-2{height:calc(var(--spacing)*2)}.h-2\.5{height:calc(var(--spacing)*2.5)}.h-3{height:calc(var(--spacing)*3)}.h-3\.5{height:calc(var(--spacing)*3.5)}.h-14{height:calc(var(--spacing)*14)}.h-14\.5{height:calc(var(--spacing)*14.5)}.min-h-screen{min-height:100vh}.w-1{width:calc(var(--spacing)*1)}.w-1\.5{width:calc(var(--spacing)*1.5)}.w-2{width:calc(var(--spacing)*2)}.w-2\.5{width:calc(var(--spacing)*2.5)}.w-3{width:calc(var(--spacing)*3)}.w-3\.5{width:calc(var(--spacing)*3.5)}.w-\[448px\]{width:448px}.w-full{width:100%}.max-w-\[335px\]{max-width:335px}.max-w-none{max-width:none}.flex-1{flex:1}.shrink-0{flex-shrink:0}.translate-y-0{--tw-translate-y:calc(var(--spacing)*0);translate:var(--tw-translate-x)var(--tw-translate-y)}.transform{transform:var(--tw-rotate-x)var(--tw-rotate-y)var(--tw-rotate-z)var(--tw-skew-x)var(--tw-skew-y)}.flex-col{flex-direction:column}.flex-col-reverse{flex-direction:column-reverse}.items-center{align-items:center}.justify-center{justify-content:center}.justify-end{justify-content:flex-end}.gap-3{gap:calc(var(--spacing)*3)}.gap-4{gap:calc(var(--spacing)*4)}:where(.space-x-1>:not(:last-child)){--tw-space-x-reverse:0;margin-inline-start:calc(calc(var(--spacing)*1)*var(--tw-space-x-reverse));margin-inline-end:calc(calc(var(--spacing)*1)*calc(1 - var(--tw-space-x-reverse)))}.overflow-hidden{overflow:hidden}.rounded-full{border-radius:3.40282e38px}.rounded-sm{border-radius:var(--radius-sm)}.rounded-t-lg{border-top-left-radius:var(--radius-lg);border-top-right-radius:var(--radius-lg)}.rounded-br-lg{border-bottom-right-radius:var(--radius-lg)}.rounded-bl-lg{border-bottom-left-radius:var(--radius-lg)}.border{border-style:var(--tw-border-style);border-width:1px}.border-\[\#19140035\]{border-color:#19140035}.border-\[\#e3e3e0\]{border-color:#e3e3e0}.border-black{border-color:var(--color-black)}.border-transparent{border-color:#0000}.bg-\[\#1b1b18\]{background-color:#1b1b18}.bg-\[\#FDFDFC\]{background-color:#fdfdfc}.bg-\[\#dbdbd7\]{background-color:#dbdbd7}.bg-\[\#fff2f2\]{background-color:#fff2f2}.bg-white{background-color:var(--color-white)}.p-6{padding:calc(var(--spacing)*6)}.px-5{padding-inline:calc(var(--spacing)*5)}.py-1{padding-block:calc(var(--spacing)*1)}.py-1\.5{padding-block:calc(var(--spacing)*1.5)}.py-2{padding-block:calc(var(--spacing)*2)}.pb-12{padding-bottom:calc(var(--spacing)*12)}.text-sm{font-size:var(--text-sm);line-height:var(--tw-leading,var(--text-sm--line-height))}.text-\[13px\]{font-size:13px}.leading-\[20px\]{--tw-leading:20px;line-height:20px}.leading-normal{--tw-leading:var(--leading-normal);line-height:var(--leading-normal)}.font-medium{--tw-font-weight:var(--font-weight-medium);font-weight:var(--font-weight-medium)}.text-\[\#1b1b18\]{color:#1b1b18}.text-\[\#706f6c\]{color:#706f6c}.text-\[\#F53003\],.text-\[\#f53003\]{color:#f53003}.text-white{color:var(--color-white)}.underline{text-decoration-line:underline}.underline-offset-4{text-underline-offset:4px}.opacity-100{opacity:1}.shadow-\[0px_0px_1px_0px_rgba\(0\,0\,0\,0\.03\)\,0px_1px_2px_0px_rgba\(0\,0\,0\,0\.06\)\]{--tw-shadow:0px 0px 1px 0px var(--tw-shadow-color,#00000008),0px 1px 2px 0px var(--tw-shadow-color,#0000000f);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.shadow-\[inset_0px_0px_0px_1px_rgba\(26\,26\,0\,0\.16\)\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#1a1a0029);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.\!filter{filter:var(--tw-blur,)var(--tw-brightness,)var(--tw-contrast,)var(--tw-grayscale,)var(--tw-hue-rotate,)var(--tw-invert,)var(--tw-saturate,)var(--tw-sepia,)var(--tw-drop-shadow,)!important}.filter{filter:var(--tw-blur,)var(--tw-brightness,)var(--tw-contrast,)var(--tw-grayscale,)var(--tw-hue-rotate,)var(--tw-invert,)var(--tw-saturate,)var(--tw-sepia,)var(--tw-drop-shadow,)}.transition-all{transition-property:all;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.transition-opacity{transition-property:opacity;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.delay-300{transition-delay:.3s}.duration-750{--tw-duration:.75s;transition-duration:.75s}.not-has-\[nav\]\:hidden:not(:has(:is(nav))){display:none}.before\:absolute:before{content:var(--tw-content);position:absolute}.before\:top-0:before{content:var(--tw-content);top:calc(var(--spacing)*0)}.before\:top-1\/2:before{content:var(--tw-content);top:50%}.before\:bottom-0:before{content:var(--tw-content);bottom:calc(var(--spacing)*0)}.before\:bottom-1\/2:before{content:var(--tw-content);bottom:50%}.before\:left-\[0\.4rem\]:before{content:var(--tw-content);left:.4rem}.before\:border-l:before{content:var(--tw-content);border-left-style:var(--tw-border-style);border-left-width:1px}.before\:border-\[\#e3e3e0\]:before{content:var(--tw-content);border-color:#e3e3e0}@media (hover:hover){.hover\:border-\[\#1915014a\]:hover{border-color:#1915014a}.hover\:border-\[\#19140035\]:hover{border-color:#19140035}.hover\:border-black:hover{border-color:var(--color-black)}.hover\:bg-black:hover{background-color:var(--color-black)}}@media (width>=64rem){.lg\:-mt-\[6\.6rem\]{margin-top:-6.6rem}.lg\:mb-0{margin-bottom:calc(var(--spacing)*0)}.lg\:mb-6{margin-bottom:calc(var(--spacing)*6)}.lg\:-ml-px{margin-left:-1px}.lg\:ml-0{margin-left:calc(var(--spacing)*0)}.lg\:block{display:block}.lg\:aspect-auto{aspect-ratio:auto}.lg\:w-\[438px\]{width:438px}.lg\:max-w-4xl{max-width:var(--container-4xl)}.lg\:grow{flex-grow:1}.lg\:flex-row{flex-direction:row}.lg\:justify-center{justify-content:center}.lg\:rounded-t-none{border-top-left-radius:0;border-top-right-radius:0}.lg\:rounded-tl-lg{border-top-left-radius:var(--radius-lg)}.lg\:rounded-r-lg{border-top-right-radius:var(--radius-lg);border-bottom-right-radius:var(--radius-lg)}.lg\:rounded-br-none{border-bottom-right-radius:0}.lg\:p-8{padding:calc(var(--spacing)*8)}.lg\:p-20{padding:calc(var(--spacing)*20)}}@media (prefers-color-scheme:dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:border-\[\#3E3E3A\]{border-color:#3e3e3a}.dark\:border-\[\#eeeeec\]{border-color:#eeeeec}.dark\:bg-\[\#0a0a0a\]{background-color:#0a0a0a}.dark\:bg-\[\#1D0002\]{background-color:#1d0002}.dark\:bg-\[\#3E3E3A\]{background-color:#3e3e3a}.dark\:bg-\[\#161615\]{background-color:#161615}.dark\:bg-\[\#eeeeec\]{background-color:#eeeeec}.dark\:text-\[\#1C1C1A\]{color:#1c1c1a}.dark\:text-\[\#A1A09A\]{color:#a1a09a}.dark\:text-\[\#EDEDEC\]{color:#ededec}.dark\:text-\[\#F61500\]{color:#f61500}.dark\:text-\[\#FF4433\]{color:#f43}.dark\:shadow-\[inset_0px_0px_0px_1px_\#fffaed2d\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#fffaed2d);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.dark\:before\:border-\[\#3E3E3A\]:before{content:var(--tw-content);border-color:#3e3e3a}@media (hover:hover){.dark\:hover\:border-\[\#3E3E3A\]:hover{border-color:#3e3e3a}.dark\:hover\:border-\[\#62605b\]:hover{border-color:#62605b}.dark\:hover\:border-white:hover{border-color:var(--color-white)}.dark\:hover\:bg-white:hover{background-color:var(--color-white)}}}@starting-style{.starting\:translate-y-4{--tw-translate-y:calc(var(--spacing)*4);translate:var(--tw-translate-x)var(--tw-translate-y)}}@starting-style{.starting\:translate-y-6{--tw-translate-y:calc(var(--spacing)*6);translate:var(--tw-translate-x)var(--tw-translate-y)}}@starting-style{.starting\:opacity-0{opacity:0}}}@keyframes spin{to{transform:rotate(360deg)}}@keyframes ping{75%,to{opacity:0;transform:scale(2)}}@keyframes pulse{50%{opacity:.5}}@keyframes bounce{0%,to{animation-timing-function:cubic-bezier(.8,0,1,1);transform:translateY(-25%)}50%{animation-timing-function:cubic-bezier(0,0,.2,1);transform:none}}@property --tw-translate-x{syntax:"*";inherits:false;initial-value:0}@property --tw-translate-y{syntax:"*";inherits:false;initial-value:0}@property --tw-translate-z{syntax:"*";inherits:false;initial-value:0}@property --tw-rotate-x{syntax:"*";inherits:false;initial-value:rotateX(0)}@property --tw-rotate-y{syntax:"*";inherits:false;initial-value:rotateY(0)}@property --tw-rotate-z{syntax:"*";inherits:false;initial-value:rotateZ(0)}@property --tw-skew-x{syntax:"*";inherits:false;initial-value:skewX(0)}@property --tw-skew-y{syntax:"*";inherits:false;initial-value:skewY(0)}@property --tw-space-x-reverse{syntax:"*";inherits:false;initial-value:0}@property --tw-border-style{syntax:"*";inherits:false;initial-value:solid}@property --tw-leading{syntax:"*";inherits:false}@property --tw-font-weight{syntax:"*";inherits:false}@property --tw-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-shadow-color{syntax:"*";inherits:false}@property --tw-inset-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-inset-shadow-color{syntax:"*";inherits:false}@property --tw-ring-color{syntax:"*";inherits:false}@property --tw-ring-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-inset-ring-color{syntax:"*";inherits:false}@property --tw-inset-ring-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-ring-inset{syntax:"*";inherits:false}@property --tw-ring-offset-width{syntax:"<length>";inherits:false;initial-value:0}@property --tw-ring-offset-color{syntax:"*";inherits:false;initial-value:#fff}@property --tw-ring-offset-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-blur{syntax:"*";inherits:false}@property --tw-brightness{syntax:"*";inherits:false}@property --tw-contrast{syntax:"*";inherits:false}@property --tw-grayscale{syntax:"*";inherits:false}@property --tw-hue-rotate{syntax:"*";inherits:false}@property --tw-invert{syntax:"*";inherits:false}@property --tw-opacity{syntax:"*";inherits:false}@property --tw-saturate{syntax:"*";inherits:false}@property --tw-sepia{syntax:"*";inherits:false}@property --tw-drop-shadow{syntax:"*";inherits:false}@property --tw-duration{syntax:"*";inherits:false}@property --tw-content{syntax:"*";inherits:false;initial-value:""}
        </style>
    @endif

    <!-- Custom color overrides for blue/purple theme -->
    <style>
        .bg-blue-theme { background-color: #2563eb; }
        .bg-purple-theme { background-color: #7c3aed; }
        .bg-indigo-theme { background-color: #4f46e5; }
        .text-blue-theme { color: #2563eb; }
        .text-purple-theme { color: #7c3aed; }
        .text-indigo-theme { color: #4f46e5; }
        .border-blue-theme { border-color: #2563eb; }
        .border-purple-theme { border-color: #7c3aed; }
        .border-indigo-theme { border-color: #4f46e5; }
        .hover\:bg-blue-theme:hover { background-color: #1d4ed8; }
        .hover\:bg-purple-theme:hover { background-color: #6d28d9; }
        .hover\:bg-indigo-theme:hover { background-color: #4338ca; }
        .dark .bg-blue-theme { background-color: #1e40af; }
        .dark .bg-purple-theme { background-color: #5b21b6; }
        .dark .bg-indigo-theme { background-color: #3730a3; }
        .dark .text-blue-theme { color: #60a5fa; }
        .dark .text-purple-theme { color: #a78bfa; }
        .dark .text-indigo-theme { color: #818cf8; }
        
        .input-field { 
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            width: 100%;
            transition: border-color 0.15s ease-in-out;
        }
        .input-field:focus { 
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        .dark .input-field {
            background-color: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        .dark .input-field:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
        }
        
        .sidebar {
            width: 260px;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        
        .sidebar-item {
            position: relative;
            transition: all 0.2s ease;
            border-radius: 0.5rem;
        }
        
        .sidebar-item:hover::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 24px;
            width: 4px;
            background: linear-gradient(to bottom, #3b82f6, #60a5fa);
            border-radius: 0 4px 4px 0;
        }
        
        .sidebar-item.active {
            background-color: rgba(59, 130, 246, 0.1);
        }
        
        .sidebar-item.active .sidebar-icon {
            color: #3b82f6;
        }
        
        .main-content {
            transition: margin-left 0.3s ease;
        }
        
        .card {
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            background: white;
        }
        
        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .course-progress {
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            background-color: #e5e7eb;
        }
        
        .course-progress-fill {
            height: 100%;
            border-radius: 4px;
            background: linear-gradient(to right, #3b82f6, #60a5fa);
            transition: width 1s ease;
        }
        
        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: linear-gradient(to bottom right, #ef4444, #f87171);
            color: white;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }
        
        .profile-image {
            border: 4px solid #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .nav-tab {
            position: relative;
            padding: 12px 16px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .nav-tab:hover {
            background-color: #f3f4f6;
        }
        
        .nav-tab.active {
            color: #3b82f6;
            font-weight: 500;
        }
        
        .nav-tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, #3b82f6, #60a5fa);
            border-radius: 3px 3px 0 0;
        }
        
        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }
        
        .status-online {
            background-color: #10b981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.3);
        }
        
        .status-offline {
            background-color: #94a3b8;
            box-shadow: 0 0 0 2px rgba(148, 163, 184, 0.3);
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }
        
        .featured-banner {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            border-radius: 1rem;
            overflow: hidden;
            position: relative;
        }
        
        .training-status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .training-status-completed {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .training-status-ongoing {
            background-color: #fef9c3;
            color: #854d0e;
        }
        
        .training-status-upcoming {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .training-status-expired {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .certification-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            margin-right: 8px;
        }
        
        .certification-valid {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .certification-expired {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f3f4f6;
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
        
        /* Mobile Sidebar */
        .mobile-sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        
        .mobile-sidebar-overlay.active {
            display: block;
        }
        
        /* Dark mode adjustments */
        .dark .card {
            background-color: #374151;
            border-color: #4b5563;
        }
        
        .dark .sidebar {
            background-color: #1f2937;
            border-color: #374151;
        }
        
        .dark .sidebar-item:hover {
            background-color: #374151;
        }
        
        .dark .sidebar-item.active {
            background-color: rgba(59, 130, 246, 0.2);
        }
        
        .dark .featured-banner {
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        }
        
        .dark .training-status-completed {
            background-color: #14532d;
            color: #86efac;
        }
        
        .dark .training-status-ongoing {
            background-color: #713f12;
            color: #fde047;
        }
        
        .dark .training-status-upcoming {
            background-color: #1e3a8a;
            color: #93c5fd;
        }
        
        .dark .training-status-expired {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        .dark .certification-valid {
            background-color: #14532d;
            color: #86efac;
        }
        
        .dark .certification-expired {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        /* New Styles for Training Schedule Page */
        .applicant-status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .applicant-status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .applicant-status-in-training {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .applicant-status-evaluating {
            background-color: #e0e7ff;
            color: #3730a3;
        }
        
        .applicant-status-approved {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .applicant-status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .applicant-status-on-hold {
            background-color: #f3f4f6;
            color: #4b5563;
        }
        
        .department-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }
        
        .department-production {
            background-color: #3b82f6;
            color: white;
        }
        
        .department-quality {
            background-color: #8b5cf6;
            color: white;
        }
        
        .department-maintenance {
            background-color: #10b981;
            color: white;
        }
        
        .department-warehouse {
            background-color: #f59e0b;
            color: white;
        }
        
        .department-admin {
            background-color: #ef4444;
            color: white;
        }
        
        .department-hr {
            background-color: #ec4899;
            color: white;
        }
        
        .progress-tracker {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            margin: 1.5rem 0;
        }
        
        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
            width: 100px;
        }
        
        .step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .step-icon.completed {
            background-color: #10b981;
            color: white;
        }
        
        .step-icon.current {
            background-color: #3b82f6;
            color: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
        }
        
        .step-icon.pending {
            background-color: #e5e7eb;
            color: #6b7280;
        }
        
        .progress-line {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            height: 2px;
            background-color: #e5e7eb;
            z-index: 0;
        }
        
        .progress-line-fill {
            height: 100%;
            background-color: #10b981;
            transition: width 0.5s ease;
        }
        
        .evaluation-card {
            border-left: 4px solid;
            transition: all 0.3s ease;
        }
        
        .evaluation-card.passed {
            border-left-color: #10b981;
        }
        
        .evaluation-card.failed {
            border-left-color: #ef4444;
        }
        
        .evaluation-card.pending {
            border-left-color: #f59e0b;
        }
        
        .skill-meter {
            height: 8px;
            border-radius: 4px;
            background-color: #e5e7eb;
            overflow: hidden;
            margin-top: 0.5rem;
        }
        
        .skill-meter-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease;
        }
        
        .skill-meter-fill.excellent {
            background-color: #10b981;
        }
        
        .skill-meter-fill.good {
            background-color: #3b82f6;
        }
        
        .skill-meter-fill.average {
            background-color: #f59e0b;
        }
        
        .skill-meter-fill.poor {
            background-color: #ef4444;
        }
        
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        .modal-overlay.active {
            display: flex;
        }
        
        .modal-content {
            background-color: white;
            border-radius: 1rem;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlideIn 0.3s ease;
        }
        
        .dark .modal-content {
            background-color: #374151;
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .filter-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb;
        }
        
        .filter-pill.active {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        
        .dark .filter-pill {
            border-color: #4b5563;
        }
        
        .dark .filter-pill.active {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                height: 100%;
                top: 0;
                left: 0;
                background: white;
            }
            
            .dark .sidebar {
                background-color: #1f2937;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0 !important;
                width: 100%;
            }
            
            .search-input {
                width: 100%;
            }
            
            .progress-tracker {
                overflow-x: auto;
                padding-bottom: 1rem;
            }
            
            .progress-step {
                min-width: 80px;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .main-grid {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .featured-banner {
                text-align: center;
                padding: 1.5rem !important;
            }
            
            .featured-banner-content {
                padding-right: 0 !important;
            }
            
            .featured-banner img {
                display: none;
            }
            
            .instructors-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .instructors-grid {
                grid-template-columns: 1fr;
            }
            
            .header-title {
                font-size: 1.5rem;
            }
            
            .featured-banner {
                text-align: center;
            }
            
            .featured-banner-button {
                width: 100%;
            }
            
            .filter-pills-container {
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }
            
            .filter-pills {
                display: flex;
                flex-wrap: nowrap;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <!-- Mobile Overlay -->
    <div class="mobile-sidebar-overlay" id="mobile-overlay"></div>

    <!-- Sidebar -->
    <div class="sidebar bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col py-6 px-4 fixed h-full z-10" id="sidebar">
        <div class="flex items-center justify-between px-2 mb-8">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-blue-theme flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                </div>
                <span class="font-bold text-xl text-gray-900 dark:text-white">Monti Textile</span>
            </div>
            
            <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400" id="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <nav class="flex-1 space-y-1">
            <a href="{{ route('hrm.staff.dashboard') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-home"></i>
                </div>
                <span class="sidebar-text font-medium">Employee Information</span>
            </a>
            
            <a href="{{ route('hrm.staff.payroll') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <span class="sidebar-text font-medium">Payroll Management</span>
            </a>
            
            <a href="{{ route('hrm.staff.leave') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <span class="sidebar-text font-medium">Leave Request</span>
            </a>
            
            <a href="{{ route('hrm.staff.attendance') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-clock"></i>
                </div>
                <span class="sidebar-text font-medium">Time and Attendance</span>
            </a>
            
            <a href="{{ route('hrm.staff.training') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <span class="sidebar-text font-medium">Training Records</span>
            </a>
            
            
            
            <div class="py-4 px-4">
                <div class="border-t border-gray-200 dark:border-gray-700"></div>
            </div>
            
            <a href="#" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-cog"></i>
                </div>
                <span class="sidebar-text font-medium">Settings</span>
            </a>
            
            <!-- Updated Logout Button -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <span class="sidebar-text font-medium">Logout</span>
            </a>
        </nav>
        
        <div class="px-4 pt-6 border-t border-gray-200 dark:border-gray-700">
            <div class="bg-blue-50 dark:bg-blue-900 rounded-xl p-4">
                <div class="text-blue-800 dark:text-blue-200 font-medium text-sm mb-2">Need help?</div>
                <p class="text-blue-600 dark:text-blue-300 text-xs mb-3">Contact our Tech support team for assistance</p>
                <button class="w-full bg-blue-theme hover:bg-blue-700 text-white py-2 rounded-lg text-xs font-medium transition-colors">
                    Get Help
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-1 ml-64 min-h-screen flex flex-col" id="main-content">
        <!-- Top Header -->
        <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 py-4 px-8 flex items-center justify-between sticky top-0 z-10">
            <div class="header-content flex items-center justify-between w-full">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white header-title">Schedule New Training</h1>
                    <p class="text-gray-500 dark:text-gray-400 hidden md:block">Manage newly hired applicants & track their training progress</p>
                </div>
                
                <div class="flex items-center space-x-4 header-actions">
                    <div class="flex items-center space-x-3">
                        <button class="md:hidden p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300" id="mobile-search-toggle">
                            <i class="fas fa-search"></i>
                        </button>
                        
                        <button class="relative p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <button class="md:hidden p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300" id="mobile-menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-medium hidden md:flex">
                            HR
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-8 overflow-y-auto custom-scrollbar">
            <!-- Training Overview Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 stats-grid">
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900 flex items-center justify-center mr-4">
                        <i class="fas fa-user-plus text-purple-600 dark:text-purple-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">New Applicants</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">12</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900 flex items-center justify-center mr-4">
                        <i class="fas fa-user-graduate text-green-600 dark:text-green-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">In Training</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">8</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-4">
                        <i class="fas fa-check-circle text-blue-600 dark:text-blue-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Approved</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">5</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center mr-4">
                        <i class="fas fa-hourglass-half text-yellow-600 dark:text-yellow-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Pending Review</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">3</div>
                    </div>
                </div>
            </div>

            <!-- Department Filter & Actions -->
            <div class="card p-6 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                    <div>
                        <h3 class="font-bold text-xl text-gray-900 dark:text-white mb-2">Newly Hired Applicants by Department</h3>
                        <p class="text-gray-500 dark:text-gray-400">Track training progress and make placement decisions</p>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <button class="px-4 py-2.5 bg-blue-theme hover:bg-blue-700 text-white rounded-xl font-medium transition-colors flex items-center">
                            <i class="fas fa-plus mr-2"></i> Add Applicant
                        </button>
                        <button class="px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex items-center">
                            <i class="fas fa-download mr-2"></i> Export
                        </button>
                    </div>
                </div>
                
                <!-- Department Filter Pills -->
                <div class="mb-6">
                    <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Filter by Department:</div>
                    <div class="filter-pills-container">
                        <div class="filter-pills flex flex-wrap gap-2">
                            <div class="filter-pill active" data-department="all">All Departments (12)</div>
                            <div class="filter-pill" data-department="production">Production (5)</div>
                            <div class="filter-pill" data-department="quality">Quality Control (3)</div>
                            <div class="filter-pill" data-department="maintenance">Maintenance (2)</div>
                            <div class="filter-pill" data-department="warehouse">Warehouse (1)</div>
                            <div class="filter-pill" data-department="admin">Administration (1)</div>
                        </div>
                    </div>
                </div>
                
                <!-- Search and Status Filter -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" placeholder="Search applicants by name or ID..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <select class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Status</option>
                            <option value="pending">Pending Training</option>
                            <option value="in-training">In Training</option>
                            <option value="evaluating">Under Evaluation</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Applicants Table -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-xl text-gray-900 dark:text-white">Applicant Training Records</h3>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Showing <span class="font-medium text-gray-900 dark:text-white">12</span> of <span class="font-medium text-gray-900 dark:text-white">12</span> applicants
                    </div>
                </div>
                
                <div class="card overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Applicant</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Department</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Hire Date</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Training Progress</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Evaluation</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <!-- Applicant 1 -->
                                <tr class="applicant-row" data-department="production">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 font-medium">
                                                JD
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Juan Dela Cruz</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">ID: APP-001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="department-badge department-production">
                                            <i class="fas fa-industry mr-1"></i> Production
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        Nov 1, 2023
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-32 mr-3">
                                                <div class="course-progress">
                                                    <div class="course-progress-fill" style="width: 75%"></div>
                                                </div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">75%</span>
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Week 3 of 4</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="applicant-status-badge applicant-status-in-training">
                                            In Training
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center text-yellow-600 dark:text-yellow-300 mr-2">
                                                <i class="fas fa-clock text-xs"></i>
                                            </div>
                                            <span class="text-sm text-gray-900 dark:text-white">Pending</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <button class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900 rounded-lg view-applicant-btn" data-id="1">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-green-900 rounded-lg approve-btn" data-id="1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900 rounded-lg reject-btn" data-id="1">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Applicant 2 -->
                                <tr class="applicant-row" data-department="quality">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center text-purple-600 dark:text-purple-300 font-medium">
                                                MS
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Maria Santos</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">ID: APP-002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="department-badge department-quality">
                                            <i class="fas fa-clipboard-check mr-1"></i> Quality Control
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        Nov 3, 2023
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-32 mr-3">
                                                <div class="course-progress">
                                                    <div class="course-progress-fill" style="width: 100%"></div>
                                                </div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">100%</span>
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Completed</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="applicant-status-badge applicant-status-evaluating">
                                            Under Evaluation
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 mr-2">
                                                <i class="fas fa-chart-bar text-xs"></i>
                                            </div>
                                            <span class="text-sm text-gray-900 dark:text-white">85% Score</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <button class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900 rounded-lg view-applicant-btn" data-id="2">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-green-900 rounded-lg approve-btn" data-id="2">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900 rounded-lg reject-btn" data-id="2">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Applicant 3 -->
                                <tr class="applicant-row" data-department="maintenance">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center text-green-600 dark:text-green-300 font-medium">
                                                RG
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Roberto Garcia</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">ID: APP-003</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="department-badge department-maintenance">
                                            <i class="fas fa-tools mr-1"></i> Maintenance
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        Oct 28, 2023
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-32 mr-3">
                                                <div class="course-progress">
                                                    <div class="course-progress-fill" style="width: 50%"></div>
                                                </div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">50%</span>
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Week 2 of 4</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="applicant-status-badge applicant-status-in-training">
                                            In Training
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center text-yellow-600 dark:text-yellow-300 mr-2">
                                                <i class="fas fa-clock text-xs"></i>
                                            </div>
                                            <span class="text-sm text-gray-900 dark:text-white">In Progress</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <button class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900 rounded-lg view-applicant-btn" data-id="3">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-green-900 rounded-lg approve-btn" data-id="3">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900 rounded-lg reject-btn" data-id="3">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Applicant 4 -->
                                <tr class="applicant-row" data-department="warehouse">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center text-yellow-600 dark:text-yellow-300 font-medium">
                                                AL
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Ana Lopez</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">ID: APP-004</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="department-badge department-warehouse">
                                            <i class="fas fa-boxes mr-1"></i> Warehouse
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        Nov 5, 2023
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-32 mr-3">
                                                <div class="course-progress">
                                                    <div class="course-progress-fill" style="width: 0%"></div>
                                                </div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">0%</span>
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Starts Nov 15</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="applicant-status-badge applicant-status-pending">
                                            Pending Training
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400 mr-2">
                                                <i class="fas fa-minus text-xs"></i>
                                            </div>
                                            <span class="text-sm text-gray-900 dark:text-white">Not Started</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <button class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900 rounded-lg view-applicant-btn" data-id="4">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-green-900 rounded-lg approve-btn" data-id="4">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900 rounded-lg reject-btn" data-id="4">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <button class="p-2 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900 rounded-lg schedule-btn" data-id="4">
                                                <i class="fas fa-calendar-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Applicant 5 -->
                                <tr class="applicant-row" data-department="production">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center text-red-600 dark:text-red-300 font-medium">
                                                MR
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Miguel Reyes</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">ID: APP-005</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="department-badge department-production">
                                            <i class="fas fa-industry mr-1"></i> Production
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        Oct 25, 2023
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-32 mr-3">
                                                <div class="course-progress">
                                                    <div class="course-progress-fill" style="width: 100%"></div>
                                                </div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">100%</span>
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Completed</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="applicant-status-badge applicant-status-approved">
                                            Approved
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center text-green-600 dark:text-green-300 mr-2">
                                                <i class="fas fa-check text-xs"></i>
                                            </div>
                                            <span class="text-sm text-gray-900 dark:text-white">92% Score</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <button class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900 rounded-lg view-applicant-btn" data-id="5">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg" disabled>
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg" disabled>
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Showing 1 to 5 of 12 applicants
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Previous
                        </button>
                        <button class="px-3 py-1.5 bg-blue-theme text-white rounded-lg">1</button>
                        <button class="px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">2</button>
                        <button class="px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">3</button>
                        <button class="px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Next
                        </button>
                    </div>
                </div>
            </div>

            <!-- Training Progress Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Training Progress by Department -->
                <div class="card p-6">
                    <h3 class="font-bold text-xl text-gray-900 dark:text-white mb-6">Training Progress by Department</h3>
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Production</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">60%</span>
                            </div>
                            <div class="course-progress">
                                <div class="course-progress-fill" style="width: 60%"></div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">5 applicants, 3 in training</div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Quality Control</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">80%</span>
                            </div>
                            <div class="course-progress">
                                <div class="course-progress-fill" style="width: 80%"></div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">3 applicants, 2 completed</div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Maintenance</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">40%</span>
                            </div>
                            <div class="course-progress">
                                <div class="course-progress-fill" style="width: 40%"></div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">2 applicants, 1 in training</div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Warehouse</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">10%</span>
                            </div>
                            <div class="course-progress">
                                <div class="course-progress-fill" style="width: 10%"></div>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">1 applicant, pending start</div>
                        </div>
                    </div>
                </div>
                
                <!-- Upcoming Training Schedule -->
                <div class="card p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-xl text-gray-900 dark:text-white">Upcoming Training Schedule</h3>
                        <a href="#" class="text-blue-theme text-sm font-medium hover:text-blue-700 dark:hover:text-blue-400">View Calendar</a>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 rounded-xl bg-blue-50 dark:bg-blue-900 border border-blue-100 dark:border-blue-800">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-800 flex items-center justify-center mr-4">
                                    <i class="fas fa-industry text-blue-600 dark:text-blue-300"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">Production Safety</h4>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">3 new hires</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-medium text-gray-900 dark:text-white">Nov 15, 2023</div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">9:00 AM</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 rounded-xl bg-purple-50 dark:bg-purple-900 border border-purple-100 dark:border-purple-800">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-purple-100 dark:bg-purple-800 flex items-center justify-center mr-4">
                                    <i class="fas fa-clipboard-check text-purple-600 dark:text-purple-300"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">Quality Standards</h4>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">2 new hires</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-medium text-gray-900 dark:text-white">Nov 18, 2023</div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">1:00 PM</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 rounded-xl bg-green-50 dark:bg-green-900 border border-green-100 dark:border-green-800">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-800 flex items-center justify-center mr-4">
                                    <i class="fas fa-tools text-green-600 dark:text-green-300"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">Machine Maintenance</h4>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">1 new hire</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-medium text-gray-900 dark:text-white">Nov 22, 2023</div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">10:00 AM</div>
                            </div>
                        </div>
                    </div>
                    
                    <button class="w-full mt-6 py-3 bg-blue-theme hover:bg-blue-700 text-white rounded-xl font-medium transition-colors">
                        Schedule New Training Session
                    </button>
                </div>
            </div>

            <!-- Evaluation Summary -->
            <div class="card p-6 mb-8">
                <h3 class="font-bold text-xl text-gray-900 dark:text-white mb-6">Training Evaluation Summary</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-5">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center text-green-600 dark:text-green-300 mr-3">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">Passed Training</div>
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">8</div>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            67% success rate
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-5">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center text-yellow-600 dark:text-yellow-300 mr-3">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">Under Evaluation</div>
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">3</div>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Awaiting HR decision
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-5">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center text-red-600 dark:text-red-300 mr-3">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">Failed/Rejected</div>
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">1</div>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Requires re-training
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Recent Evaluations</h4>
                    <div class="space-y-3">
                        <div class="evaluation-card passed p-4 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white">Carlos Mendoza</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Production Department</div>
                                </div>
                                <div class="text-right">
                                    <div class="font-medium text-green-600 dark:text-green-400">Approved</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Nov 10, 2023</div>
                                </div>
                            </div>
                            <div class="mt-3 text-sm text-gray-600 dark:text-gray-300">
                                Excellent performance in machine operation training. Recommended for immediate placement.
                            </div>
                        </div>
                        
                        <div class="evaluation-card failed p-4 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white">Elena Torres</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Quality Control</div>
                                </div>
                                <div class="text-right">
                                    <div class="font-medium text-red-600 dark:text-red-400">Rejected</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Nov 8, 2023</div>
                                </div>
                            </div>
                            <div class="mt-3 text-sm text-gray-600 dark:text-gray-300">
                                Failed to meet quality standards assessment. Recommended for re-training or alternative department.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Applicant Detail Modal -->
    <div class="modal-overlay" id="applicant-modal">
        <div class="modal-content">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-2xl text-gray-900 dark:text-white">Applicant Details</h3>
                    <button class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" id="close-modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <!-- Modal content will be loaded here -->
                <div id="modal-content">
                    <!-- Content loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        // Toggle sidebar
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileSearchToggle = document.getElementById('mobile-search-toggle');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        
        // Function to toggle sidebar
        function toggleSidebar() {
            if (window.innerWidth < 1024) {
                // Mobile behavior
                sidebar.classList.toggle('active');
                mobileOverlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            } else {
                // Desktop behavior
                sidebar.classList.toggle('collapsed');
                mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '80px' : '260px';
            }
        }
        
        // Function to close sidebar on mobile
        function closeSidebar() {
            if (window.innerWidth < 1024) {
                sidebar.classList.remove('active');
                mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }
        
        // Event listeners
        sidebarToggle.addEventListener('click', toggleSidebar);
        mobileMenuToggle.addEventListener('click', toggleSidebar);
        mobileOverlay.addEventListener('click', closeSidebar);
        
        // Department Filter Functionality
        const filterPills = document.querySelectorAll('.filter-pill');
        const applicantRows = document.querySelectorAll('.applicant-row');
        
        filterPills.forEach(pill => {
            pill.addEventListener('click', function() {
                // Remove active class from all pills
                filterPills.forEach(p => p.classList.remove('active'));
                // Add active class to clicked pill
                this.classList.add('active');
                
                const department = this.getAttribute('data-department');
                
                // Show/hide applicant rows based on filter
                applicantRows.forEach(row => {
                    if (department === 'all' || row.getAttribute('data-department') === department) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
        
        // Applicant Detail Modal
        const applicantModal = document.getElementById('applicant-modal');
        const closeModalBtn = document.getElementById('close-modal');
        const viewApplicantBtns = document.querySelectorAll('.view-applicant-btn');
        const modalContent = document.getElementById('modal-content');
        
        // Sample applicant data for modal
        const applicantData = {
            1: {
                name: "Juan Dela Cruz",
                id: "APP-001",
                department: "Production",
                hireDate: "November 1, 2023",
                status: "In Training",
                progress: 75,
                trainingStart: "November 8, 2023",
                trainingEnd: "December 6, 2023",
                trainer: "Engr. Rodriguez",
                skills: [
                    { name: "Machine Operation", level: 80, rating: "Good" },
                    { name: "Safety Compliance", level: 90, rating: "Excellent" },
                    { name: "Quality Awareness", level: 70, rating: "Good" },
                    { name: "Teamwork", level: 85, rating: "Excellent" }
                ],
                evaluations: [
                    { date: "Nov 15, 2023", evaluator: "Supervisor Santos", score: 78, comment: "Good progress, needs more practice on machine #3" },
                    { date: "Nov 22, 2023", evaluator: "Trainer Rodriguez", score: 85, comment: "Showing improvement, safety protocols well understood" }
                ],
                notes: "Quick learner, shows good potential for production line work."
            },
            2: {
                name: "Maria Santos",
                id: "APP-002",
                department: "Quality Control",
                hireDate: "November 3, 2023",
                status: "Under Evaluation",
                progress: 100,
                trainingStart: "November 6, 2023",
                trainingEnd: "November 27, 2023",
                trainer: "QA Manager Lim",
                skills: [
                    { name: "Quality Inspection", level: 90, rating: "Excellent" },
                    { name: "Documentation", level: 85, rating: "Excellent" },
                    { name: "Attention to Detail", level: 95, rating: "Excellent" },
                    { name: "Problem Solving", level: 80, rating: "Good" }
                ],
                evaluations: [
                    { date: "Nov 20, 2023", evaluator: "QA Manager Lim", score: 92, comment: "Exceptional attention to detail, quick to identify defects" },
                    { date: "Nov 24, 2023", evaluator: "Supervisor Tan", score: 88, comment: "Good understanding of quality standards" }
                ],
                notes: "Highly recommended for quality control position. Has previous experience in textile quality."
            },
            3: {
                name: "Roberto Garcia",
                id: "APP-003",
                department: "Maintenance",
                hireDate: "October 28, 2023",
                status: "In Training",
                progress: 50,
                trainingStart: "November 13, 2023",
                trainingEnd: "December 11, 2023",
                trainer: "Chief Engineer Lee",
                skills: [
                    { name: "Mechanical Skills", level: 75, rating: "Good" },
                    { name: "Troubleshooting", level: 70, rating: "Average" },
                    { name: "Preventive Maintenance", level: 65, rating: "Average" },
                    { name: "Safety Procedures", level: 85, rating: "Excellent" }
                ],
                evaluations: [
                    { date: "Nov 20, 2023", evaluator: "Engineer Lee", score: 72, comment: "Basic skills good, needs more practice on complex repairs" }
                ],
                notes: "Shows good mechanical aptitude but needs more hands-on experience."
            }
        };
        
        // Function to open modal with applicant details
        function openApplicantModal(applicantId) {
            const applicant = applicantData[applicantId];
            if (!applicant) return;
            
            // Determine rating class
            function getRatingClass(level) {
                if (level >= 90) return 'excellent';
                if (level >= 80) return 'good';
                if (level >= 70) return 'average';
                return 'poor';
            }
            
            // Generate modal content
            modalContent.innerHTML = `
                <div class="space-y-6">
                    <!-- Applicant Header -->
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 text-2xl font-bold">
                                ${applicant.name.split(' ').map(n => n[0]).join('')}
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-gray-900 dark:text-white">${applicant.name}</h4>
                                <p class="text-gray-500 dark:text-gray-400">ID: ${applicant.id}</p>
                                <div class="flex items-center space-x-2 mt-2">
                                    <span class="department-badge department-${applicant.department.toLowerCase().replace(' ', '-')}">
                                        ${applicant.department}
                                    </span>
                                    <span class="applicant-status-badge applicant-status-${applicant.status.toLowerCase().replace(' ', '-')}">
                                        ${applicant.status}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Hire Date</div>
                            <div class="font-medium text-gray-900 dark:text-white">${applicant.hireDate}</div>
                        </div>
                    </div>
                    
                    <!-- Training Progress -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-5">
                        <h5 class="font-bold text-lg text-gray-900 dark:text-white mb-4">Training Progress</h5>
                        <div class="mb-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Overall Progress</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">${applicant.progress}%</span>
                            </div>
                            <div class="course-progress">
                                <div class="course-progress-fill" style="width: ${applicant.progress}%"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Training Period</div>
                                <div class="font-medium text-gray-900 dark:text-white">${applicant.trainingStart} - ${applicant.trainingEnd}</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Assigned Trainer</div>
                                <div class="font-medium text-gray-900 dark:text-white">${applicant.trainer}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Skills Assessment -->
                    <div>
                        <h5 class="font-bold text-lg text-gray-900 dark:text-white mb-4">Skills Assessment</h5>
                        <div class="space-y-4">
                            ${applicant.skills.map(skill => `
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">${skill.name}</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">${skill.level}% (${skill.rating})</span>
                                    </div>
                                    <div class="skill-meter">
                                        <div class="skill-meter-fill ${getRatingClass(skill.level)}" style="width: ${skill.level}%"></div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    
                    <!-- Evaluations -->
                    <div>
                        <h5 class="font-bold text-lg text-gray-900 dark:text-white mb-4">Training Evaluations</h5>
                        <div class="space-y-3">
                            ${applicant.evaluations.map(eval => `
                                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">${eval.evaluator}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">${eval.date}</div>
                                        </div>
                                        <div class="text-lg font-bold text-blue-600 dark:text-blue-400">${eval.score}%</div>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">${eval.comment}</p>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    
                    <!-- Notes -->
                    <div>
                        <h5 class="font-bold text-lg text-gray-900 dark:text-white mb-2">HR Notes</h5>
                        <div class="bg-yellow-50 dark:bg-yellow-900 border border-yellow-100 dark:border-yellow-800 rounded-lg p-4">
                            <p class="text-sm text-gray-700 dark:text-gray-300">${applicant.notes}</p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <button class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700">
                            <i class="fas fa-download mr-2"></i> Export Report
                        </button>
                        <button class="px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl approve-btn-modal" data-id="${applicantId}">
                            <i class="fas fa-check mr-2"></i> Approve
                        </button>
                        <button class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl reject-btn-modal" data-id="${applicantId}">
                            <i class="fas fa-times mr-2"></i> Reject
                        </button>
                    </div>
                </div>
            `;
            
            // Open modal
            applicantModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Add event listeners to modal buttons
            document.querySelector('.approve-btn-modal')?.addEventListener('click', function() {
                approveApplicant(this.getAttribute('data-id'));
            });
            
            document.querySelector('.reject-btn-modal')?.addEventListener('click', function() {
                rejectApplicant(this.getAttribute('data-id'));
            });
        }
        
        // Function to close modal
        function closeModal() {
            applicantModal.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        // Event listeners for modal
        closeModalBtn.addEventListener('click', closeModal);
        applicantModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Event listeners for view buttons
        viewApplicantBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const applicantId = this.getAttribute('data-id');
                openApplicantModal(applicantId);
            });
        });
        
        // Function to approve applicant
        function approveApplicant(applicantId) {
            // Find the row in the table
            const row = document.querySelector(`.view-applicant-btn[data-id="${applicantId}"]`)?.closest('tr');
            if (!row) return;
            
            // Update status badge
            const statusCell = row.querySelector('.applicant-status-badge');
            statusCell.textContent = 'Approved';
            statusCell.className = 'applicant-status-badge applicant-status-approved';
            
            // Update evaluation cell
            const evalCell = row.querySelector('.flex.items-center:has(.fa-clock, .fa-chart-bar, .fa-minus, .fa-check)');
            if (evalCell) {
                evalCell.innerHTML = `
                    <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center text-green-600 dark:text-green-300 mr-2">
                        <i class="fas fa-check text-xs"></i>
                    </div>
                    <span class="text-sm text-gray-900 dark:text-white">Approved</span>
                `;
            }
            
            // Show success message
            showToast('Applicant approved successfully!', 'success');
            closeModal();
        }
        
        // Function to reject applicant
        function rejectApplicant(applicantId) {
            // Find the row in the table
            const row = document.querySelector(`.view-applicant-btn[data-id="${applicantId}"]`)?.closest('tr');
            if (!row) return;
            
            // Update status badge
            const statusCell = row.querySelector('.applicant-status-badge');
            statusCell.textContent = 'Rejected';
            statusCell.className = 'applicant-status-badge applicant-status-rejected';
            
            // Update evaluation cell
            const evalCell = row.querySelector('.flex.items-center:has(.fa-clock, .fa-chart-bar, .fa-minus, .fa-check)');
            if (evalCell) {
                evalCell.innerHTML = `
                    <div class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center text-red-600 dark:text-red-300 mr-2">
                        <i class="fas fa-times text-xs"></i>
                    </div>
                    <span class="text-sm text-gray-900 dark:text-white">Rejected</span>
                `;
            }
            
            // Show success message
            showToast('Applicant rejected successfully!', 'error');
            closeModal();
        }
        
        // Event listeners for approve/reject buttons in table
        document.querySelectorAll('.approve-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const applicantId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to approve this applicant?')) {
                    approveApplicant(applicantId);
                }
            });
        });
        
        document.querySelectorAll('.reject-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const applicantId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to reject this applicant?')) {
                    rejectApplicant(applicantId);
                }
            });
        });
        
        // Schedule training button functionality
        document.querySelectorAll('.schedule-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const applicantId = this.getAttribute('data-id');
                showToast('Training scheduling modal would open here', 'info');
                // In a real app, this would open a scheduling modal
            });
        });
        
        // Toast notification function
        function showToast(message, type) {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-transform duration-300 ${
                type === 'success' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                type === 'error' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' :
                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300'
            }`;
            toast.textContent = message;
            
            // Add to DOM
            document.body.appendChild(toast);
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
        
        // Initialize progress animations
        document.addEventListener('DOMContentLoaded', () => {
            const progressBars = document.querySelectorAll('.course-progress-fill');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });
            
            // Handle responsive behavior on load
            if (window.innerWidth < 1024) {
                mainContent.style.marginLeft = '0';
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth < 1024) {
                mainContent.style.marginLeft = '0';
                sidebar.classList.remove('collapsed');
                
                // Close sidebar if open when resizing to mobile
                if (sidebar.classList.contains('active')) {
                    document.body.style.overflow = '';
                }
            } else {
                // Reset to desktop behavior
                mobileOverlay.classList.remove('active');
                sidebar.classList.remove('active');
                document.body.style.overflow = '';
                
                // Apply collapsed state if needed
                mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '80px' : '260px';
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && applicantModal.classList.contains('active')) {
                closeModal();
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
