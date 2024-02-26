var labelType, useGradients, nativeTextSupport, animate;

(function () {
    var ua = navigator.userAgent,
            iStuff = ua.match(/iPhone/i) || ua.match(/iPad/i),
            typeOfCanvas = typeof HTMLCanvasElement,
            nativeCanvasSupport = (typeOfCanvas == 'object' || typeOfCanvas == 'function'),
            textSupport = nativeCanvasSupport
            && (typeof document.createElement('canvas').getContext('2d').fillText == 'function');
    //I'm setting this based on the fact that ExCanvas provides text support for IE
    //and that as of today iPhone/iPad current text support is lame
    labelType = (!nativeCanvasSupport || (textSupport && !iStuff)) ? 'Native' : 'HTML';
    nativeTextSupport = labelType == 'Native';
    useGradients = nativeCanvasSupport;
    animate = !(iStuff || !nativeCanvasSupport);
})();

var Log = {
    elem: false,
    write: function (text) {
        if (!this.elem)
            this.elem = document.getElementById('log');
        this.elem.innerHTML = text;
        this.elem.style.left = (500 - this.elem.offsetWidth / 2) + 'px';
    }
};

function init() {    
    //init data    
    var disp_orientation = "top";

    //end
    //init Spacetree
    //Create a new ST instance
    var st = new $jit.ST({
        //id of viz container element
        injectInto: 'genealogy-content',
        //set duration for the animation
        duration: 800,
        levelsToShow: 1,
        //set animation transition type
        transition: $jit.Trans.Quart.easeInOut,
        //set distance between node and its children
        levelDistance: 50,
        offsetY: 100,
        //enable panning
        Navigation: {
            enable: true,
            panning: true
        },
        //set node and edge styles
        //set overridable=true for styling individual
        //nodes or edges
        Node: {
            height: 50,
            width: 140,
            type: 'rectangle',
            color: '#fff',
            overridable: true
        },
        Edge: {
            type: 'bezier',
            overridable: true
        },
        orientation: disp_orientation,
        onBeforeCompute: function (node) {
            Log.write("loading " + node.name);
        },
        onAfterCompute: function () {
            Log.write("done");
        },
        //This method is called on DOM label creation.
        //Use this method to add event handlers and styles to
        //your node.
        onCreateLabel: function (label, node) {
            label.id = node.id;
            if (node.data.userType == -1) {
                label.innerHTML = "<img width='40' height='40' src='" + emptyImageUrl + "' > <br>" + node.name;
            } else {
                label.innerHTML = "<img width='32' height='32' src='" + userImageUrl +"' > <br>" + node.name;
            }
            label.onclick = function () {
                st.onClick(node.id);

            };
            //set label styles
            var style = label.style;
            style.width = 140 + 'px';
            style.height = 40 + 'px';
            style.cursor = 'pointer';
            style.fontSize = '1em';
            style.textAlign = 'center';
            style.paddingBottom = '50px';
        },
        //This method is called right before plotting
        //a node. It's useful for changing an individual node
        //style properties before plotting it.
        //The data properties prefixed with a dollar
        //sign will override the global node style properties.
        onBeforePlotNode: function (node) {
            //add some color to the nodes in the path between the
            //root node and the selected node.
            if (node.selected) {
                // node.data.$color = "#ff7";
                node.data.$color = "#fff";
            } else {
                delete node.data.$color;
                //if the node belongs to the last plotted level
                if (!node.anySubnode("exist")) {
                    //count children number
                    var count = 0;
                    node.eachSubnode(function (n) {
                        count++;
                    });
                    //assign a node color based on
                    //how many children it has
                    //node.data.$color = ['#aaa', '#baa', '#caa', '#daa', '#eaa', '#faa'][count];  
                    if (count == 0) {
                        node.data.$color = ['#fff'][0];
                    } else
                        node.data.$color = ['#fff'][0];
                }
            }
        },
        //This method is called right before plotting
        //an edge. It's useful for changing an individual edge
        //style properties before plotting it.
        //Edge data proprties prefixed with a dollar sign will
        //override the Edge global style properties.
        onBeforePlotLine: function (adj) {
            if (adj.nodeFrom.selected && adj.nodeTo.selected) {
                adj.data.$color = "#ccc";
                adj.data.$lineWidth = 1;
            } else {
                delete adj.data.$color;
                delete adj.data.$lineWidth;
            }
        }
    });
    //load json data        
    st.loadJSON(json);    
    //compute node positions and layout
    st.compute();
    //optional: make a translation of the tree
    st.geom.translate(new $jit.Complex(-200, 0), "current");
    //emulate a click on the root node.
    st.onClick(st.root);
    //end
    //Add event handlers to switch spacetree orientation.    
    //end
}
