package bytesol.pcip.model
{
import bytesol.pcip.events.ColorEvent;

import com.lorentz.SVG.display.SVGG;
import com.lorentz.SVG.display.SVGPath;
import com.lorentz.SVG.display.base.SVGElement;

import flash.events.EventDispatcher;
import flash.net.SharedObject;

import mx.collections.ArrayCollection;
import mx.collections.ArrayList;

[Event(name="color", type="bytesol.pcip.events.ColorEvent")]

[Bindable] 
public class AppModel extends EventDispatcher
{
  private static var instance:AppModel;

  public static function getInstance() : AppModel 
  {  
    if(instance == null)                  
      instance = new AppModel( new SingletonEnforcer );
    return instance;
  }

  public function AppModel(enforcer:SingletonEnforcer)
  {
    if (enforcer == null) 
      throw new Error("You can only have one AppModel");
    
    var so:SharedObject = SharedObject.getLocal(SHARED_OBJECT);
    if (so.size > 0) 
    {
      try  
      {
        if(so.data.hasOwnProperty("login"))
          login = so.data.login;
        if(so.data.hasOwnProperty("rememberMe"))
          rememberMe = so.data.rememberMe;
      }
      catch(e:Error){}
    }
//    for(var i:int = 0; i < 250; i++)
//      seats.addItem("na" + (i + 1).toString());
  }
  
  public function saveSettings():void
  {
    var so:SharedObject = SharedObject.getLocal(SHARED_OBJECT);
    so.data.login = login;
    so.data.rememberMe = rememberMe;
    so.flush();
  }
  
  public function logOut():void
  {
    loggedUser = "";
    loggedUserType = "";
    userData.removeAll();
    tags.removeAll();
    layers.removeAll();
//    saveSettings();
  }
  
  public function get zoom():Number
  {
    return _zoom; 
  }
  
  public function set zoom(v:Number):void
  {
    if(v >= ZOOM_MIN && v <= ZOOM_MAX)
      _zoom = v;
  }
  
  public function set selElement(v:SVGElement):void
  {
    if(_selElement)
      _selElement.alpha = 1.0;

    _selElement = v;
    
    if(_selElement)
    {
      _selElement.alpha = SELECTED_ALPHA;
      selSeat = getSeatName(_selElement); 
      if(_selElement.transform.colorTransform)
        selColor = _selElement.transform.colorTransform.color;
      else
        selColor = DEFAULT_COLOR;
    }
    else
    {
      selSeat = "";
      selColor = DEFAULT_COLOR;  
    }
    trace(selSeat, selColor.toString(16));
  }
  
  public function getSeatName(element:SVGElement):String
  {
    if(element)
      return element.id.split('_')[0];
    return "";
  }
  
  public function get selElement():SVGElement
  {
    return _selElement; 
  }
  
  public function updateColor(seat:String, color:String):void
  {
//    trace("ColorEvent", seat, color.toString(16));    
    dispatchEvent(new ColorEvent(ColorEvent.COLOR, seat, color)); 
  }
  
  private var _selElement:SVGElement = null;
  private var _zoom:Number = 1.0;
  public var selSeat:String = "";
  public var selColor:uint = DEFAULT_COLOR;
  public var selLayer:int = -1;
  
  public var login:String = "";
  public var loggedUser:String = "";
  public var loggedUserType:String = "";
  public var rememberMe:Boolean = false;
  
//  public var seats:ArrayList = new ArrayList();
  public var layers:ArrayList = new ArrayList();
  public var tags:ArrayList = new ArrayList();
  public var userData:ArrayCollection = new ArrayCollection();
  
  public var seats:Vector.<SVGPath> = new Vector.<SVGPath>();
  public var mapLayers:Vector.<SVGG> = new Vector.<SVGG>();
  
  public const SELECTED_ALPHA:Number  = 0.2;
  public const OVER_ALPHA:Number      = 0.7;
  public const ZOOM_MIN:Number        = 1.0;
  public const ZOOM_MAX:Number        = 3.1;
  public const URL_SERVICE:String     = "/service.php";
  public const URL_LOGIN:String       = URL_SERVICE + "/site/login"; 
  public const URL_LOGOUT:String      = URL_SERVICE + "/site/logout"; 
  public const URL_LOGIN_TEST:String  = URL_SERVICE + "/user/details"; 
  public const URL_LAYERS:String      = URL_SERVICE + "/layer/layers"; 
  public const URL_TAGS:String        = URL_SERVICE + "/layer/tags"; 
  public const URL_USER_DATA:String   = URL_SERVICE + "/userData/layer"; 
  public const URL_ADD_DATA:String    = URL_SERVICE + "/userData/create"; 
  public const URL_UPDATE_DATA:String = URL_SERVICE + "/userData/update"; 
  public const URL_DEL_DATA:String    = URL_SERVICE + "/userData/delete";
  public const URL_MAP:String         = "assets/map.svg"; 
//  public const URL_MAP_ZIP:String     = "assets/map.zip"; 
  public const URL_MAP_ZLIB:String    = "assets/map.zlib";
  public const TAG_COLOR:String       = "color";
  public const READ_ONLY_USR_TYPE:String = "demo";
  public const DEFAULT_COLOR:uint     = 0x00000000;
  public const LAYER_REGIONS:String   = "layer2";
  private const SHARED_OBJECT:String  = "SHARED_OBJ_PCIP";
}
}

// Utility Class to Deny Access to Constructor
class SingletonEnforcer {}