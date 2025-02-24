<?php 

namespace App\Http\Controllers\Api\Docs;


class ChatMessageControllerDoc
{

/****************************************************

 public function chat($id){}

*****************************************************/
 /**
 * @OA\Get(
 * path="/api/v1/chat-message?user_id={user_id}&per_page={per_page}&page={page}",
 * summary="Get all old messages",
 * description="Get Message",
 * operationId="getChatMessage",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="user_id",
 *      in="path",
 *      required=true,
 *		example="45",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
  *   @OA\Parameter(
 *      name="page",
 *      in="path",
 *      required=true,
 *		example="1",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
  *   @OA\Parameter(
 *      name="per_page",
 *      in="path",
 *      required=true,
 *		example="10",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */


/****************************************************

 public function refreshMessage($id, $lmi){}

*****************************************************/
/**
 * @OA\Get(
 * path="/api/v1/chat-refresh?user_id={user_id}&last_msg={last_msg_id}",
 * summary="Get current message response",
 * description="Get Message Response",
 * operationId="getChatMessageResponse",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="user_id",
 *      in="path",
 *      required=true,
 *		example="45",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="last_msg_id",
 *      in="path",
 *		example="156",
 *      required=true,
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   ),
 */




/****************************************************

 public function getInboxMessage(){}

*****************************************************/
/**
 * @OA\Get(
 * path="/api/v1/inbox-message?page={page}&per_page={per_page}",
 * summary="get inbox message",
 * description="Get Inbox Message",
 * operationId="getIndoxMessage",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
   *   @OA\Parameter(
 *      name="page",
 *      in="path",
 *      required=true,
 *		example="1",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
  *   @OA\Parameter(
 *      name="per_page",
 *      in="path",
 *      required=true,
 *		example="10",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   ),
 */



/****************************************************

 public function getAllUser(){}

*****************************************************/
/**
 * @OA\Get(
 * path="/api/v1/getalluser?page={page}&per_page={per_page}",
 * summary="get all user",
 * description="Get ALl User",
 * operationId="getALlUserMessage",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="page",
 *      in="path",
 *      required=true,
 *		example="1",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="per_page",
 *      in="path",
 *      required=true,
 *		example="10",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   ),
 */



/****************************************************

 public function getAllReadMsg(){}

*****************************************************/
/**
 * @OA\Get(
 * path="/api/v1/getallreaduser?page={page}&per_page={per_page}",
 * summary="get read message",
 * description="Get Read Message",
 * operationId="getAllReadMessage",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="page",
 *      in="path",
 *      required=true,
 *		example="1",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="per_page",
 *      in="path",
 *      required=true,
 *		example="10",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   ),
 */


/****************************************************

 public function getAllUnreadMsg(){}

*****************************************************/
/**
 * @OA\Get(
 * path="/api/v1/getallunreaduser?page={page}&per_page={per_page}",
 * summary="get unread message",
 * description="Get Unread Message",
 * operationId="getUnreadMessage",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="page",
 *      in="path",
 *      required=true,
 *		example="1",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="per_page",
 *      in="path",
 *      required=true,
 *		example="10",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   ),
 */


/****************************************************

 public function sendMessage(){}

*****************************************************/
/**
 * @OA\Post(
 * path="/api/v1/chat-message",
 * summary="sent chat message",
 * description="Send Message",
 * operationId="sendChatMessage",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
 *     	@OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="message_file",
 *                      description="message_file",
 *                      type="file",
 *                      @OA\Items(type="string", format="binary")
 *                   ),
 *               ),
 *           ),
 *       ),
 *   @OA\Parameter(
 *      name="received_by",
 *      in="path",
 *      required=true,
 *		example="45",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="message",
 *      in="path",
 *      required=true,
 *		example="Text message string",
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 * ),
 */



/****************************************************

 public function getAllContact($id, $lmi){}

*****************************************************/
/**
 * @OA\Get(
 * path="/api/v1/get-all-contact?page={page}&per_page={per_page}",
 * summary="Get All Contacts",
 * description="Get All Contacts",
 * operationId="GetAllContacts",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Parameter(
 *      name="page",
 *      in="path",
 *      required=true,
 *		example="1",
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="per_page",
 *      in="path",
 *		example="10",
 *      required=true,
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   ),
 */



/****************************************************

 public function deleteInboxMessage(){}

*****************************************************/
/**
 * @OA\Post(
 * path="/api/v1/delete-message",
 * summary="delete chat message",
 * description="delete Message",
 * operationId="deleteChatMessage",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"message_id"},
 *       @OA\Property(
 *			property="message_id", 
 *			type="string", 
 *			format="text", 
 *			example="80"
 *		),    
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 * ),
 */


/****************************************************

 public function massDeleteInboxMessage(){}

*****************************************************/
/**
 * @OA\Post(
 * path="/api/v1/mass-delete-message",
 * summary="mass delete chat message",
 * description="Mass Delete  Message",
 * operationId="deleteMassChatMessage",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"message_id"},
 *       @OA\Property(
 *			property="message_id", 
 *			type="object",
 *			example="[80,91]"
 *		),
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 * ),
 */



/****************************************************

 public function getLoadLatestMessages(){}

*****************************************************/
/**
 * @OA\Get(
 * path="/api/v1/load-latest-messages?user_id=45",
 * summary="load latest chat messages",
 * description="load latest chat messages",
 * operationId="loadlatestchatmessages",
 * tags={"Chat"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   ),
 */

/****************************************************

 public function getOldMessages(){}

*****************************************************/
/**
 * @OA\Get(
 * path="/api/v1/fetch-old-messages?old_message_id=50&to_user=45",
 * summary="fetch last chat messages",
 * description="fetch last chat messages",
 * operationId="fetchlastchatmessages",
 * tags={"Chat"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   ),
 */


/****************************************************

 public function postSendMessage(){}

*****************************************************/
/**
 * @OA\Post(
 * path="/api/v1/send",
 * summary="sent chat message",
 * description="Send Message",
 * operationId="sendChat",
 * tags={"Chat"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"received_by","message"},
 *       @OA\Property(
 *			property="to_user", 
 *			type="string", 
 *			format="text", 
 *			example="45"
 *		),
 *       @OA\Property(
 *			property="message", 
 *			type="string", 
 *			format="text", 
 *			example="send message"
 *		),       
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 * ),
 */


/****************************************************

 public function postSendMessage(){}

*****************************************************/
/**
 * @OA\Post(
 * path="/api/v1/send/del",
 * summary="delete chat message",
 * description="Delete Message",
 * operationId="deleteChat",
 * tags={"Chat"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"received_by","message"},
 *       @OA\Property(
 *			property="user_id", 
 *			type="string", 
 *			format="text", 
 *			example="45"
 *		),   
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 * ),
 */




/****************************************************

 public function autoreplySetting(){}

*****************************************************/
/**
 * @OA\Post(
 * path="/api/v1/autoreply-setting",
 * summary="Auto Reply Settings",
 * description="Auto Reply Settings",
 * operationId="AutoReplySettings",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"auto_reply", "message"},
 *		@OA\Property(
 *			property="auto_reply", 
 *			type="string", 
 *			format="text", 
 *			example="1"
 *		),
 *       @OA\Property(
 *			property="message", 
 *			type="string", 
 *			format="text", 
 *			example="auto send mesage"
 *		),       
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 * ),
 */

/****************************************************

 public function getAutoMessage(){}

*****************************************************/
/**
 * @OA\Get(
 * path="/api/v1/autoreply-setting",
 * summary="Get Auto Reply Message",
 * description="Get Auto Reply Message",
 * operationId="GetAutoReplyMessage",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   ),
 */

/****************************************************

 public function sendAutoMessage(){}

*****************************************************/
/**
 * @OA\Get(
 * path="/api/v1/auto-reply",
 * summary="Auto Reply Message",
 * description="Auto Reply Message",
 * operationId="AutoReplyMessage",
 * tags={"Message"},
 * security={
 *    {"bearer": {}}
 * },
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   ),
 */



}
