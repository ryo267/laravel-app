const THREE = require("three");
const OrbitControls = require("three-orbitcontrols");
//import { OBJLoader } from "three/examples/jsm/loaders/OBJLoader";
import { GLTFLoader } from "three/examples/jsm/loaders/GLTFLoader.js";
//import {CSS3DRenderer,CSS3DObject,CSS3DSprite} from "three/examples/jsm/renderers/CSS3DRenderer.js";
const fontJson = require("three/examples/fonts/helvetiker_regular.typeface.json");

// or all tools are exported from the "all" file (excluding bonus plugins):
//import { gsap, ScrollTrigger, Draggable, MotionPathPlugin } from "gsap/all";
import { TimelineMax } from "gsap/all";
// don't forget to register plugins
//gsap.registerPlugin(ScrollTrigger, Draggable, MotionPathPlugin);

const DEBUG = false;

const canvas = document.getElementById("canvas"); // canvas要素の取得

const width = window.innerWidth;
const height = window.innerHeight;
const fov = 60;
const fovRad = (fov / 2) * (Math.PI / 180); // 視野角をラジアンに変換
const dist = height / 2 / Math.tan(fovRad); // ウィンドウぴったりのカメラ距離

let camera, scene, renderer;
let mouse = new THREE.Vector2(0, 0);
let scroll_y = window.scrollY;
let mixers = [];
const trigers = [
    {
        nav: document.getElementById("r_nav"),
        nav_2: document.getElementById("r_nav_2"),
        nav_wrap: document.getElementById("r_icon_wrap"),
        triger: -2000,
        isActive: false,
        x: 300,
        y: 300
    },
    {
        nav: document.getElementById("o_nav"),
        nav_2: document.getElementById("o_nav_2"),
        nav_wrap: document.getElementById("o_icon_wrap"),
        triger: -4000,
        isActive: false,
        x: 300,
        y: -300
    },
    {
        nav: document.getElementById("b_nav"),
        nav_2: document.getElementById("b_nav_2"),
        nav_wrap: document.getElementById("b_icon_wrap"),
        triger: -6000,
        isActive: false,
        x: -300,
        y: 300
    },
    {
        nav: document.getElementById("p_nav"),
        nav_2: document.getElementById("p_nav_2"),
        nav_wrap: document.getElementById("p_icon_wrap"),
        triger: -8000,
        isActive: false,
        x: -300,
        y: -300
    },
    {
        nav: document.getElementById("g_nav"),
        nav_2: document.getElementById("g_nav_2"),
        nav_wrap: document.getElementById("g_icon_wrap"),
        triger: -10000,
        isActive: false,
        x: 0,
        y: 300
    }
];
const timeline = new TimelineMax();
const clock = new THREE.Clock();
const flactal = new THREE.PointsMaterial({
    map: new THREE.TextureLoader().load("/texture/fractal-2573310_640.jpg"),
    // 色
    color: 0x2196f3,
    // 一つ一つのサイズ
    size: 1,
    blending: THREE.AdditiveBlending, // ブレンドモード
    transparent: true, // 透過true
    depthTest: false // 物体が重なった時に後ろにあるものを描画するかしないか
});

const modelInfoSet = [
    /*
    {
        name: "city",
        scale: 0.1,
        position: [0, 0, 0],
        Shadow: true,
        vector3: true,
        url: "/model/city_model/scene.gltf"
    },
    */
    {
        name: "earth",
        scale: 1,
        position: [0, 0, 350],
        material: flactal,
        vector3: false,
        url: "/model/earth_hologram/scene.gltf"
    }
];

init();
animate();
onResize();
//event();
//mouseEvent();

function init() {
    cameraConfig();

    renderConfig();

    rightConfig();

    //if (DEBUG) cameraControl();

    movieConfig();

    //loadModel(modelInfoSet);
}

function animate() {
    requestAnimationFrame(animate);
    //Animation Mixerを実行
    if (mixers.length > 0) {
        for (let i = 0; i < mixers.length; i++) {
            let mixer = mixers[i];
            mixer.update(clock.getDelta());
        }
    }

    /*
    mesh.rotation.x += 0.01;
    mesh.rotation.y += 0.02;
    
    sphere.rotation.x += 0.01;
    sphere.rotation.y += 0.02;
    */

    //rot += 0.1; // 毎フレーム角度を0.5度ずつ足していく
    //x_radius += 1;
    //z_radius += 1;

    /*
    if (!flag) {
        y_radius += 1;
        if (y_radius == 100) {
            flag = true;
        }
    } else {
        y_radius -= 1;
        if (y_radius == -100) {
            flag = false;
        }
    }
    // ラジアンに変換する
    const radian = (rot * Math.PI) / 180;
    */
    // 角度に応じてカメラの位置を設定
    /*
    mesh_2.position.x = x_radius * Math.sin(radian);
    mesh_2.position.y = y_radius * Math.sin(radian);
    mesh_2.position.z = z_radius * Math.cos(radian);
    */
    /*
    mesh_2.geometry.vertices.forEach(function(e) {
        e.set(
            (e.x -= 0.01),
            (e.y -= 0.01),
            (e.z -= 0.01)
        );
        console.log("update1");
    });

    mesh_2.geometry.verticesNeedUpdate = true;
    mesh_2.geometry.elementNeedUpdate = true;
    mesh_2.geometry.computeFaceNormals();
    */

    //tick();
    renderer.render(scene, camera);
}

function onResize() {
    window.addEventListener("resize", function() {
        // レンダラーのサイズを調整する
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.setSize(canvas.clientWidth, canvas.clientHeight);

        // カメラのアスペクト比を正す
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
    });
}

// 毎フレーム時に実行されるループイベントです
function tick() {
    rot += 0.1;

    // ラジアンに変換する
    const radian = (rot * Math.PI) / 180;
    // 角度に応じてカメラの位置を設定
    camera.position.x = 110 * Math.sin(radian);
    camera.position.z = 110 * Math.cos(radian);
    // 原点方向を見つめる
    camera.lookAt(new THREE.Vector3(0, 100, 0));

    /*
    // レンダリング
    renderer.render(scene, camera);
    requestAnimationFrame(tick);
    */
}

function getVector3(object, material, scale) {
    if (object.geometry == undefined) {
        console.log("undefiend");
        for (let i = 0; i < object.children.length; i++) {
            getVector3(object.children[i]);
        }
        return;
    } else {
        console.log("defiend");
        const geometry = new THREE.Geometry();
        // 配置する範囲
        const SIZE = scale;
        for (
            let i = 0;
            i < object.geometry.attributes.position.array.length;
            i += 3
        ) {
            geometry.vertices.push(
                new THREE.Vector3(
                    SIZE * object.geometry.attributes.position.array[i + 0],
                    SIZE * object.geometry.attributes.position.array[i + 2],
                    SIZE * object.geometry.attributes.position.array[i + 1]
                )
            );
        }
        const mesh = new THREE.Points(geometry, material);
        scene.add(mesh);
        return;
    }
}

function setMaterial(object, material) {
    if (object.material == undefined) {
        if (DEBUG) console.log("setMaterial");
        for (let i = 0; i < object.children.length; i++) {
            setMaterial(object.children[i], material);
        }
        return;
    } else {
        if (DEBUG) console.log("setMaterial");
        //object.material.colorWrite = false;
        var texture = new THREE.TextureLoader().load(
            "/texture/fractal-2573310_640.jpg"
        );
        object.material = material;
        return;
    }
}

function loadModel(json) {
    var loader = new GLTFLoader();
    for (let i = 0; i < json.length; i++) {
        let model = json[i];
        let url = model.url;
        let scale = model.scale;
        let material = model.material;
        let texture = model.texture;
        let vector3 = model.vector3;
        loader.load(
            url,
            function(data) {
                console.log(data);
                const gltf = data;
                const object = gltf.scene;
                object.scale.set(scale, scale, scale);
                object.position.set(
                    model.position[0],
                    model.position[1],
                    model.position[2]
                );
                const animations = gltf.animations;

                if (animations && animations.length) {
                    //Animation Mixerインスタンスを生成
                    let mixer = new THREE.AnimationMixer(object);

                    //全てのAnimation Clipに対して
                    for (let i = 0; i < animations.length; i++) {
                        let animation = animations[i];

                        //Animation Actionを生成
                        let action = mixer.clipAction(animation);

                        //ループ設定（1回のみ）
                        //action.setLoop(THREE.LoopOnce);

                        //アニメーションの最後のフレームでアニメーションが終了
                        //action.clampWhenFinished = true;

                        //アニメーションを再生
                        action.play();
                    }

                    mixers.push(mixer);
                }

                if (material) {
                    if (texture) {
                        setTexture(material, texture);
                    }
                    setMaterial(object, material);
                }
                if (model.Shadow) {
                    if (DEBUG) console.log("castShadow");
                    model.castShadow = true;
                }
                if (vector3) getVector3(object, material, scale);
                if (DEBUG) console.log(object);
                scene.add(object);
            },
            undefined,
            function(error) {
                console.error(error);
            }
        );
    }
}

function setTexture(material, texture) {
    if (DEBUG) console.log("setTexture");
    var tex = new THREE.TextureLoader().load(texture);
    material.map = tex;
}

function cameraControl() {
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.25;
    controls.enableZoom = true;
}

function rightConfig() {
    /*
    // 環境光源を作成
    // new THREE.AmbientLight(色, 光の強さ)
    const light = new THREE.AmbientLight(0xffffff, 10.0);
    scene.add(light);
    */

    // 平行光源を作成
    // new THREE.DirectionalLight(色, 光の強さ)
    var dirLight = new THREE.DirectionalLight(0xffffff, 1);
    dirLight.castShadow = true;
    scene.add(dirLight);

    // 照明を作成
    const spotLight = new THREE.SpotLight(0xffffff);
    //potLight.position.set(100, 1000, 100);
    spotLight.position.set(
        camera.position.x,
        camera.position.y + 10,
        camera.position.z
    );
    spotLight.lookAt(new THREE.Vector3(0, 0, 0));

    spotLight.castShadow = true;

    spotLight.shadow.mapSize.width = 1024;
    spotLight.shadow.mapSize.height = 1024;

    spotLight.shadow.camera.near = 500;
    spotLight.shadow.camera.far = 4000;
    spotLight.shadow.camera.fov = 30;

    scene.add(spotLight);
}

function event() {
    let nav_flag = false;
    let sum = 0;
    let flag = true;

    window.addEventListener("wheel", event => {
        console.log(event.wheelDelta);
        sum += event.wheelDelta;
        if (sum <= trigers[4].triger-2000) {
            sum = trigers[4].triger-2000;
        } else if (0 < sum) {
            sum = 0;
        }
        console.log(sum);
        trigers.forEach(e => {
            if (sum <= e.triger) {
                document.getElementById("said_nav").style.width = "100%";
                e.nav.classList.add("active");
                e.nav_2.classList.add("active");
                e.nav_wrap.classList.add("active");
                e.isActive = true;
                console.log("open");
            } else {
                e.isActive = false;
                e.nav.classList.remove("active");
                e.nav_2.classList.remove("active");
                e.nav_wrap.classList.remove("active");

                for (let i = 0; i < trigers.length; i++) {
                    if (trigers[i].isActive) {
                        //console.log(trigers[i].nav);
                        nav_flag = false;
                        break;
                    } else {
                        nav_flag = true;
                    }
                }
                if (nav_flag) {
                    document.getElementById("said_nav").style.width = "80px";
                }

                console.log("close");
            }
        });
        
        for (let i = trigers.length - 1; i >= 0; i--) {
            if (trigers[i].isActive) {
                flag = false;
                timeline.to(camera.position, 0.5, {
                    x: trigers[i].x,
                    y: trigers[i].y
                });
                //camera.position.set(trigers[i].x, trigers[i].y, dist);
                console.log(trigers[i].x);
                console.log(trigers[i].y);
                break;
            } else {
                flag = true;
                console.log(flag);
            }
        }
        if (flag) {
            console.log("cameraInit()");
            cameraInit();
        }
        
    });
}

function mouseEvent() {
    window.addEventListener("mousemove", e => {
        mouse.x = e.clientX - width / 2; // 原点を中心に持ってくる
        mouse.y = -e.clientY + height / 2; // 軸を反転して原点を中心に持ってくる

        camera.position.set(mouse.x, mouse.y, dist);
    });
}

function cameraConfig() {
    // カメラを作成 (視野角, 画面のアスペクト比, カメラに映る最短距離, カメラに映る最遠距離)
    camera = new THREE.PerspectiveCamera(fov, width / height, 1, dist * 2);
    camera.position.z = dist; // カメラを遠ざける
    camera.lookAt(new THREE.Vector3(0, 0, 0));
}

function cameraInit() {
    timeline.to(camera.position, 0.5, {
        x: 0,
        y: 0
    });
}

function renderConfig() {
    scene = new THREE.Scene();
    //scene.background = new THREE.Color(0xa0a0a0);
    //scene.fog = new THREE.Fog(0xa0a0a0, 10, 250);

    renderer = new THREE.WebGLRenderer();
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(canvas.clientWidth, canvas.clientHeight); // レンダラーのサイズをdivのサイズに設定
    // レンダラー：シャドウを有効にする
    renderer.shadowMap.enabled = true;
    canvas.appendChild(renderer.domElement);

    //読み込んだシーンが暗いので、明るくする
    renderer.outputEncoding = THREE.GammaEncoding;
}

function giometries() {
    /*
    // 床を作成
    const meshFloor = new THREE.Mesh(
        new THREE.BoxGeometry(2000, 0.1, 2000),
        new THREE.MeshStandardMaterial()
    );
    // 影を受け付ける
    meshFloor.receiveShadow = true;
    scene.add(meshFloor);
    */

    /*
    // 形状データを作成
    var geometry_2 = new THREE.Geometry();

    // 配置する範囲
    const SIZE = 500;
    // 配置する個数
    const LENGTH = 1000;
    for (let i = 0; i < LENGTH; i++) {
        geometry_2.vertices.push(
            new THREE.Vector3(
                SIZE * (Math.random() - 0.5),
                SIZE * (Math.random() - 0.5),
                SIZE * (Math.random() - 0.5)
            )
        );
    }

    mesh_2 = new THREE.Points(geometry_2, flactal);
    scene.add(mesh_2);
    */

    /*
    shpere_g = new THREE.SphereGeometry(5, 32, 32);
    sphere_m = new THREE.MeshBasicMaterial({ color: 0x2196f3 });
    sphere = new THREE.Mesh(shpere_g, sphere_m);
    scene.add(sphere);
    */

    /*
    const font = new THREE.FontLoader().parse(fontJson);
    var textGeometry = new THREE.TextGeometry("Hello three.js!", {
        font: font,
        size: 80,
        height: 5,
        curveSegments: 12,
        bevelEnabled: true,
        bevelThickness: 10,
        bevelSize: 8,
        bevelOffset: 0,
        bevelSegments: 5
    });

    var text_m = new THREE.MeshBasicMaterial({ color: 0x2196f3 });
    var text = new THREE.Mesh(textGeometry, text_m);
    scene.add(text);
    */

    /*
    var geometry = new THREE.BoxGeometry(300, 300, 300);
    var material = new THREE.MeshBasicMaterial({ color: 0x2196f3 });
    var mesh = new THREE.Mesh(geometry, material);
    scene.add(mesh);
    */

    if (DEBUG) {
        var axis = new THREE.AxisHelper(100); // 長さ100の軸オブジェクトを生成
        scene.add(axis); // シーンにオブジェクトを追加
    }
}

function movieConfig() {
    // videoエレメント作成
    var video = document.createElement("video");
    // テクスチャにする動画の指定
    video.src = "/movie/Network - 12716.mp4";
    // 動画をループ再生
    video.loop = true;
    // 動画のロード＆再生
    video.crossOrigin = "anonymous";
    video.muted = true;
    video.autoplay = true;
    video.play();

    console.log(video);

    // 動画テクスチャ作成
    var movie_texture = new THREE.VideoTexture(video);
    // 1テクセルが1ピクセルより大きな範囲をカバーするときのテクスチャサンプリング方法の指定
    movie_texture.magFilter = THREE.LinearFilter;
    // 1テクセルが1ピクセルより小さな範囲をカバーするときのテクスチャサンプリング方法の指定
    movie_texture.minFilter = THREE.LinearFilter;
    // 動画テクスチャフォーマットの指定
    movie_texture.format = THREE.RGBFormat;

    console.log(movie_texture);

    // マテリアルの作成
    const movie_material = new THREE.MeshBasicMaterial({
        map: movie_texture
    });

    // ジオメトリの作成
    var geometry = new THREE.BoxGeometry(2000, 2000, 0.1);

    // オブジェクトの作成
    const movie_box = new THREE.Mesh(geometry, movie_material);
    scene.add(movie_box);
}
