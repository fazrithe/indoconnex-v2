(function(){var e=!1,t=function(e){return e instanceof t?e:this instanceof t?void(this.EXIFwrapped=e):new t(e)};"undefined"!=typeof exports?("undefined"!=typeof module&&module.exports&&(exports=module.exports=t),exports.EXIF=t):this.EXIF=t;var r=t.Tags={36864:"ExifVersion",40960:"FlashpixVersion",40961:"ColorSpace",40962:"PixelXDimension",40963:"PixelYDimension",37121:"ComponentsConfiguration",37122:"CompressedBitsPerPixel",37500:"MakerNote",37510:"UserComment",40964:"RelatedSoundFile",36867:"DateTimeOriginal",36868:"DateTimeDigitized",37520:"SubsecTime",37521:"SubsecTimeOriginal",37522:"SubsecTimeDigitized",33434:"ExposureTime",33437:"FNumber",34850:"ExposureProgram",34852:"SpectralSensitivity",34855:"ISOSpeedRatings",34856:"OECF",37377:"ShutterSpeedValue",37378:"ApertureValue",37379:"BrightnessValue",37380:"ExposureBias",37381:"MaxApertureValue",37382:"SubjectDistance",37383:"MeteringMode",37384:"LightSource",37385:"Flash",37396:"SubjectArea",37386:"FocalLength",41483:"FlashEnergy",41484:"SpatialFrequencyResponse",41486:"FocalPlaneXResolution",41487:"FocalPlaneYResolution",41488:"FocalPlaneResolutionUnit",41492:"SubjectLocation",41493:"ExposureIndex",41495:"SensingMethod",41728:"FileSource",41729:"SceneType",41730:"CFAPattern",41985:"CustomRendered",41986:"ExposureMode",41987:"WhiteBalance",41988:"DigitalZoomRation",41989:"FocalLengthIn35mmFilm",41990:"SceneCaptureType",41991:"GainControl",41992:"Contrast",41993:"Saturation",41994:"Sharpness",41995:"DeviceSettingDescription",41996:"SubjectDistanceRange",40965:"InteroperabilityIFDPointer",42016:"ImageUniqueID"},i=t.TiffTags={256:"ImageWidth",257:"ImageHeight",34665:"ExifIFDPointer",34853:"GPSInfoIFDPointer",40965:"InteroperabilityIFDPointer",258:"BitsPerSample",259:"Compression",262:"PhotometricInterpretation",274:"Orientation",277:"SamplesPerPixel",284:"PlanarConfiguration",530:"YCbCrSubSampling",531:"YCbCrPositioning",282:"XResolution",283:"YResolution",296:"ResolutionUnit",273:"StripOffsets",278:"RowsPerStrip",279:"StripByteCounts",513:"JPEGInterchangeFormat",514:"JPEGInterchangeFormatLength",301:"TransferFunction",318:"WhitePoint",319:"PrimaryChromaticities",529:"YCbCrCoefficients",532:"ReferenceBlackWhite",306:"DateTime",270:"ImageDescription",271:"Make",272:"Model",305:"Software",315:"Artist",33432:"Copyright"},o=t.GPSTags={0:"GPSVersionID",1:"GPSLatitudeRef",2:"GPSLatitude",3:"GPSLongitudeRef",4:"GPSLongitude",5:"GPSAltitudeRef",6:"GPSAltitude",7:"GPSTimeStamp",8:"GPSSatellites",9:"GPSStatus",10:"GPSMeasureMode",11:"GPSDOP",12:"GPSSpeedRef",13:"GPSSpeed",14:"GPSTrackRef",15:"GPSTrack",16:"GPSImgDirectionRef",17:"GPSImgDirection",18:"GPSMapDatum",19:"GPSDestLatitudeRef",20:"GPSDestLatitude",21:"GPSDestLongitudeRef",22:"GPSDestLongitude",23:"GPSDestBearingRef",24:"GPSDestBearing",25:"GPSDestDistanceRef",26:"GPSDestDistance",27:"GPSProcessingMethod",28:"GPSAreaInformation",29:"GPSDateStamp",30:"GPSDifferential"},a=t.IFD1Tags={256:"ImageWidth",257:"ImageHeight",258:"BitsPerSample",259:"Compression",262:"PhotometricInterpretation",273:"StripOffsets",274:"Orientation",277:"SamplesPerPixel",278:"RowsPerStrip",279:"StripByteCounts",282:"XResolution",283:"YResolution",284:"PlanarConfiguration",296:"ResolutionUnit",513:"JpegIFOffset",514:"JpegIFByteCount",529:"YCbCrCoefficients",530:"YCbCrSubSampling",531:"YCbCrPositioning",532:"ReferenceBlackWhite"},s=t.StringValues={ExposureProgram:{0:"Not defined",1:"Manual",2:"Normal program",3:"Aperture priority",4:"Shutter priority",5:"Creative program",6:"Action program",7:"Portrait mode",8:"Landscape mode"},MeteringMode:{0:"Unknown",1:"Average",2:"CenterWeightedAverage",3:"Spot",4:"MultiSpot",5:"Pattern",6:"Partial",255:"Other"},LightSource:{0:"Unknown",1:"Daylight",2:"Fluorescent",3:"Tungsten (incandescent light)",4:"Flash",9:"Fine weather",10:"Cloudy weather",11:"Shade",12:"Daylight fluorescent (D 5700 - 7100K)",13:"Day white fluorescent (N 4600 - 5400K)",14:"Cool white fluorescent (W 3900 - 4500K)",15:"White fluorescent (WW 3200 - 3700K)",17:"Standard light A",18:"Standard light B",19:"Standard light C",20:"D55",21:"D65",22:"D75",23:"D50",24:"ISO studio tungsten",255:"Other"},Flash:{0:"Flash did not fire",1:"Flash fired",5:"Strobe return light not detected",7:"Strobe return light detected",9:"Flash fired, compulsory flash mode",13:"Flash fired, compulsory flash mode, return light not detected",15:"Flash fired, compulsory flash mode, return light detected",16:"Flash did not fire, compulsory flash mode",24:"Flash did not fire, auto mode",25:"Flash fired, auto mode",29:"Flash fired, auto mode, return light not detected",31:"Flash fired, auto mode, return light detected",32:"No flash function",65:"Flash fired, red-eye reduction mode",69:"Flash fired, red-eye reduction mode, return light not detected",71:"Flash fired, red-eye reduction mode, return light detected",73:"Flash fired, compulsory flash mode, red-eye reduction mode",77:"Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected",79:"Flash fired, compulsory flash mode, red-eye reduction mode, return light detected",89:"Flash fired, auto mode, red-eye reduction mode",93:"Flash fired, auto mode, return light not detected, red-eye reduction mode",95:"Flash fired, auto mode, return light detected, red-eye reduction mode"},SensingMethod:{1:"Not defined",2:"One-chip color area sensor",3:"Two-chip color area sensor",4:"Three-chip color area sensor",5:"Color sequential area sensor",7:"Trilinear sensor",8:"Color sequential linear sensor"},SceneCaptureType:{0:"Standard",1:"Landscape",2:"Portrait",3:"Night scene"},SceneType:{1:"Directly photographed"},CustomRendered:{0:"Normal process",1:"Custom process"},WhiteBalance:{0:"Auto white balance",1:"Manual white balance"},GainControl:{0:"None",1:"Low gain up",2:"High gain up",3:"Low gain down",4:"High gain down"},Contrast:{0:"Normal",1:"Soft",2:"Hard"},Saturation:{0:"Normal",1:"Low saturation",2:"High saturation"},Sharpness:{0:"Normal",1:"Soft",2:"Hard"},SubjectDistanceRange:{0:"Unknown",1:"Macro",2:"Close view",3:"Distant view"},FileSource:{3:"DSC"},Components:{0:"",1:"Y",2:"Cb",3:"Cr",4:"R",5:"G",6:"B"}};function u(e){return!!e.exifdata}function l(n,r){function i(i){var o=c(i);n.exifdata=o||{};var a=function(t){var n=new DataView(t);e;if(255!=n.getUint8(0)||216!=n.getUint8(1))return!1;var r=2,i=t.byteLength,o=function(e,t){return 56===e.getUint8(t)&&66===e.getUint8(t+1)&&73===e.getUint8(t+2)&&77===e.getUint8(t+3)&&4===e.getUint8(t+4)&&4===e.getUint8(t+5)};for(;r<i;){if(o(n,r)){var a=n.getUint8(r+7);return a%2!=0&&(a+=1),0===a&&(a=4),f(t,r+8+a,n.getUint16(r+6+a))}r++}}(i);if(n.iptcdata=a||{},t.isXmpEnabled){var s=function(t){if(!("DOMParser"in self))return;var n=new DataView(t);e;if(255!=n.getUint8(0)||216!=n.getUint8(1))return!1;var r=2,i=t.byteLength,o=new DOMParser;for(;r<i-4;){if("http"==p(n,r,4)){var a=r-1,s=n.getUint16(r-2)-1,u=p(n,a,s),l=u.indexOf("xmpmeta>")+8,c=(u=u.substring(u.indexOf("<x:xmpmeta"),l)).indexOf("x:xmpmeta")+10;return u=u.slice(0,c)+'xmlns:Iptc4xmpCore="http://iptc.org/std/Iptc4xmpCore/1.0/xmlns/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:tiff="http://ns.adobe.com/tiff/1.0/" xmlns:plus="http://schemas.android.com/apk/lib/com.google.android.gms.plus" xmlns:ext="http://www.gettyimages.com/xsltExtension/1.0" xmlns:exif="http://ns.adobe.com/exif/1.0/" xmlns:stEvt="http://ns.adobe.com/xap/1.0/sType/ResourceEvent#" xmlns:stRef="http://ns.adobe.com/xap/1.0/sType/ResourceRef#" xmlns:crs="http://ns.adobe.com/camera-raw-settings/1.0/" xmlns:xapGImg="http://ns.adobe.com/xap/1.0/g/img/" xmlns:Iptc4xmpExt="http://iptc.org/std/Iptc4xmpExt/2008-02-29/" '+u.slice(c),P(o.parseFromString(u,"text/xml"))}r++}}(i);n.xmpdata=s||{}}r&&r.call(n)}if(n.src)if(/^data\:/i.test(n.src))i(function(e,t){t=t||e.match(/^data\:([^\;]+)\;base64,/im)[1]||"",e=e.replace(/^data\:([^\;]+)\;base64,/gim,"");for(var n=atob(e),r=n.length,i=new ArrayBuffer(r),o=new Uint8Array(i),a=0;a<r;a++)o[a]=n.charCodeAt(a);return i}(n.src));else if(/^blob\:/i.test(n.src)){(a=new FileReader).onload=function(e){i(e.target.result)},function(e,t){var n=new XMLHttpRequest;n.open("GET",e,!0),n.responseType="blob",n.onload=function(e){200!=this.status&&0!==this.status||t(this.response)},n.send()}(n.src,(function(e){a.readAsArrayBuffer(e)}))}else{var o=new XMLHttpRequest;o.onload=function(){if(200!=this.status&&0!==this.status)throw"Could not load image";i(o.response),o=null},o.open("GET",n.src,!0),o.responseType="arraybuffer",o.send(null)}else if(self.FileReader&&(n instanceof self.Blob||n instanceof self.File)){var a;(a=new FileReader).onload=function(e){i(e.target.result)},a.readAsArrayBuffer(n)}}function c(e){var t=new DataView(e);if(255!=t.getUint8(0)||216!=t.getUint8(1))return!1;for(var n=2,r=e.byteLength;n<r;){if(255!=t.getUint8(n))return!1;if(225==t.getUint8(n+1))return h(t,n+4,t.getUint16(n+2));n+=2+t.getUint16(n+2)}}var d={120:"caption",110:"credit",25:"keywords",55:"dateCreated",80:"byline",85:"bylineTitle",122:"captionWriter",105:"headline",116:"copyright",15:"category"};function f(e,t,n){for(var r,i,o,a,s=new DataView(e),u={},l=t;l<t+n;)28===s.getUint8(l)&&2===s.getUint8(l+1)&&(a=s.getUint8(l+2))in d&&((o=s.getInt16(l+3))+5,i=d[a],r=p(s,l+5,o),u.hasOwnProperty(i)?u[i]instanceof Array?u[i].push(r):u[i]=[u[i],r]:u[i]=r),l++;return u}function g(e,t,n,r,i){var o,a,s=e.getUint16(n,!i),u={};for(a=0;a<s;a++)o=n+12*a+2,u[r[e.getUint16(o,!i)]]=m(e,o,t,n,i);return u}function m(e,t,n,r,i){var o,a,s,u,l,c,d=e.getUint16(t+2,!i),f=e.getUint32(t+4,!i),g=e.getUint32(t+8,!i)+n;switch(d){case 1:case 7:if(1==f)return e.getUint8(t+8,!i);for(o=f>4?g:t+8,a=[],u=0;u<f;u++)a[u]=e.getUint8(o+u);return a;case 2:return p(e,o=f>4?g:t+8,f-1);case 3:if(1==f)return e.getUint16(t+8,!i);for(o=f>2?g:t+8,a=[],u=0;u<f;u++)a[u]=e.getUint16(o+2*u,!i);return a;case 4:if(1==f)return e.getUint32(t+8,!i);for(a=[],u=0;u<f;u++)a[u]=e.getUint32(g+4*u,!i);return a;case 5:if(1==f)return l=e.getUint32(g,!i),c=e.getUint32(g+4,!i),(s=new Number(l/c)).numerator=l,s.denominator=c,s;for(a=[],u=0;u<f;u++)l=e.getUint32(g+8*u,!i),c=e.getUint32(g+4+8*u,!i),a[u]=new Number(l/c),a[u].numerator=l,a[u].denominator=c;return a;case 9:if(1==f)return e.getInt32(t+8,!i);for(a=[],u=0;u<f;u++)a[u]=e.getInt32(g+4*u,!i);return a;case 10:if(1==f)return e.getInt32(g,!i)/e.getInt32(g+4,!i);for(a=[],u=0;u<f;u++)a[u]=e.getInt32(g+8*u,!i)/e.getInt32(g+4+8*u,!i);return a}}function p(e,t,r){var i="";for(n=t;n<t+r;n++)i+=String.fromCharCode(e.getUint8(n));return i}function h(e,t){if("Exif"!=p(e,t,4))return!1;var n,u,l,c,d,f=t+6;if(18761==e.getUint16(f))n=!1;else{if(19789!=e.getUint16(f))return!1;n=!0}if(42!=e.getUint16(f+2,!n))return!1;var m=e.getUint32(f+4,!n);if(m<8)return!1;if((u=g(e,f,f+m,i,n)).ExifIFDPointer)for(l in c=g(e,f,f+u.ExifIFDPointer,r,n)){switch(l){case"LightSource":case"Flash":case"MeteringMode":case"ExposureProgram":case"SensingMethod":case"SceneCaptureType":case"SceneType":case"CustomRendered":case"WhiteBalance":case"GainControl":case"Contrast":case"Saturation":case"Sharpness":case"SubjectDistanceRange":case"FileSource":c[l]=s[l][c[l]];break;case"ExifVersion":case"FlashpixVersion":c[l]=String.fromCharCode(c[l][0],c[l][1],c[l][2],c[l][3]);break;case"ComponentsConfiguration":c[l]=s.Components[c[l][0]]+s.Components[c[l][1]]+s.Components[c[l][2]]+s.Components[c[l][3]]}u[l]=c[l]}if(u.GPSInfoIFDPointer)for(l in d=g(e,f,f+u.GPSInfoIFDPointer,o,n)){if("GPSVersionID"===l)d[l]=d[l][0]+"."+d[l][1]+"."+d[l][2]+"."+d[l][3];u[l]=d[l]}return u.thumbnail=function(e,t,n,r){var i=function(e,t,n){var r=e.getUint16(t,!n);return e.getUint32(t+2+12*r,!n)}(e,t+n,r);if(!i)return{};if(i>e.byteLength)return{};var o=g(e,t,t+i,a,r);if(o.Compression)switch(o.Compression){case 6:if(o.JpegIFOffset&&o.JpegIFByteCount){var s=t+o.JpegIFOffset,u=o.JpegIFByteCount;o.blob=new Blob([new Uint8Array(e.buffer,s,u)],{type:"image/jpeg"})}break;case 1:console.log("Thumbnail image format is TIFF, which is not implemented.");break;default:console.log("Unknown thumbnail image format '%s'",o.Compression)}else 2==o.PhotometricInterpretation&&console.log("Thumbnail image format is RGB, which is not implemented.");return o}(e,f,m,n),u}function S(e){var t={};if(1==e.nodeType){if(e.attributes.length>0){t["@attributes"]={};for(var n=0;n<e.attributes.length;n++){var r=e.attributes.item(n);t["@attributes"][r.nodeName]=r.nodeValue}}}else if(3==e.nodeType)return e.nodeValue;if(e.hasChildNodes())for(var i=0;i<e.childNodes.length;i++){var o=e.childNodes.item(i),a=o.nodeName;if(null==t[a])t[a]=S(o);else{if(null==t[a].push){var s=t[a];t[a]=[],t[a].push(s)}t[a].push(S(o))}}return t}function P(e){try{var t={};if(e.children.length>0)for(var n=0;n<e.children.length;n++){var r=e.children.item(n),i=r.attributes;for(var o in i){var a=i[o],s=a.nodeName,u=a.nodeValue;void 0!==s&&(t[s]=u)}var l=r.nodeName;if(void 0===t[l])t[l]=S(r);else{if(void 0===t[l].push){var c=t[l];t[l]=[],t[l].push(c)}t[l].push(S(r))}}else t=e.textContent;return t}catch(e){console.log(e.message)}}t.enableXmp=function(){t.isXmpEnabled=!0},t.disableXmp=function(){t.isXmpEnabled=!1},t.getData=function(e,t){return!((self.Image&&e instanceof self.Image||self.HTMLImageElement&&e instanceof self.HTMLImageElement)&&!e.complete)&&(u(e)?t&&t.call(e):l(e,t),!0)},t.getTag=function(e,t){if(u(e))return e.exifdata[t]},t.getIptcTag=function(e,t){if(u(e))return e.iptcdata[t]},t.getAllTags=function(e){if(!u(e))return{};var t,n=e.exifdata,r={};for(t in n)n.hasOwnProperty(t)&&(r[t]=n[t]);return r},t.getAllIptcTags=function(e){if(!u(e))return{};var t,n=e.iptcdata,r={};for(t in n)n.hasOwnProperty(t)&&(r[t]=n[t]);return r},t.pretty=function(e){if(!u(e))return"";var t,n=e.exifdata,r="";for(t in n)n.hasOwnProperty(t)&&("object"==typeof n[t]?n[t]instanceof Number?r+=t+" : "+n[t]+" ["+n[t].numerator+"/"+n[t].denominator+"]\r\n":r+=t+" : ["+n[t].length+" values]\r\n":r+=t+" : "+n[t]+"\r\n");return r},t.readFromBinaryFile=function(e){return c(e)},"function"==typeof define&&define.amd&&define("exif-js",[],(function(){return t}))}).call(this);