package bytesol.pcip.vo
{
import flash.utils.ByteArray;
import flash.utils.CompressionAlgorithm;
import flash.utils.Endian;

public class Zip
{
  private const SIGNATURE:uint = 0x04034b50;
  private const DEFLATE:uint = 8;
  private const UNCOMPRESSED:uint = 8;
  
  private var fileName:String; 
  private var flNameLength:uint; 
  private var xfldLength:uint; 
  private var offset:uint; 
  private var compSize:uint; 
  private var uncompSize:uint; 
  private var compMethod:int; 
  
  private var file:ByteArray;
  
  public function Zip():void
  {
  }
  
  public function uncompress(data:ByteArray):ByteArray
  {
    trace("Zip Size", data.length); 
    data.endian = Endian.LITTLE_ENDIAN;
    data.position = 0;
    // Signature 4 bytes
    if (data.readUnsignedInt() != SIGNATURE) 
      throw new Error("Not a valid Zip File.");
    // Required Version 2 bytes
    data.readUnsignedShort(); 
    // General Purpose Bit Flag 2 bytes
    data.readUnsignedShort(); 
    // Compression Method 2 bytes
    compMethod = data.readUnsignedShort();  
    if (compMethod != DEFLATE && compMethod != UNCOMPRESSED) 
      throw new Error("Unsupported compression.");
    // Last Modified File Time 2 bytes
    data.readUnsignedShort();  
    // Last Modified File Date 2 bytes
    data.readUnsignedShort();  
    // CRC 4 bytes
    data.readUnsignedInt();
    // Compressed Size 4 bytes
    compSize = data.readUnsignedInt();  
    // UnCompressed Size 4 bytes
    uncompSize = data.readUnsignedInt();   
    // File name length 2 bytes
    flNameLength = data.readShort();
    // Extra field length 2 bytes
    xfldLength = data.readShort(); 
    
    offset = 30;      
    offset += flNameLength;      
    offset += xfldLength;    
    
    fileName = data.readUTFBytes(flNameLength); // read file name
    trace(fileName);  
    trace("Compressed Size", compSize); 
    trace("Uncompressed Size", uncompSize);     
    trace("Offset", data.position);
    if(xfldLength > 0)
      data.readBytes(new ByteArray(), 0, xfldLength);
    
    data.readBytes(file, 0, compSize);
    
    if(compMethod == DEFLATE)
    {
      trace("comp file Size", file.length);     
      file.inflate(); 
    }
    trace("decomp file Size", file.length);     
    return file;
  }
}
}